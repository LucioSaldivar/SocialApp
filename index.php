<?php
declare(strict_types=1);

use DI\ContainerBuilder;

use SocialApp\Controllers\Action\Save;
use SocialApp\Controllers\Action\Delete;
use SocialApp\Controllers\Action\Update;
use SocialApp\Controllers\SocialMedias;
use SocialApp\Controllers\SocialRatings;
use SocialApp\Controllers\AddRating;
use SocialApp\Controllers\GetSocialMedia;
use SocialApp\Model\Calculation\AverageCalculator;
use SocialApp\Model\SocialMediaModel;
use SocialApp\Model\SocialRatingModel;
use SocialApp\Repositories\SocialMediaRepository;
use SocialApp\Repositories\SocialRatingRepository;
use SocialApp\Processors\SocialMediaModelFactory;
use SocialApp\Processors\SocialRatingModelFactory;
use SocialApp\Setup\ApiConnection;
use SocialApp\views\ModelView\SocialMediaBlock;
use SocialApp\views\ListView\SocialMediaAll;
use SocialApp\views\ListView\SocialRatingAll;
use SocialApp\views\Forms\Rating;
use SocialApp\views\Forms\EditRating;

use FastRoute\RouteCollector;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Narrowspark\HttpEmitter\SapiEmitter;
use Relay\Relay;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use function DI\create;
use function DI\get;
use function FastRoute\simpleDispatcher;

require_once './vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(true);
$containerBuilder->useAnnotations(false);
$containerBuilder->addDefinitions(
    [
        'Response' => create(Response::class)->constructor(),
        'AverageCalculator' => create(AverageCalculator::class)->constructor(get('SocialRatingRepository')),

        'SocialMediaModel' => create(SocialMediaModel::class)->constructor(),
        'SocialMediaModelFactory' => create(SocialMediaModelFactory::class)->constructor(get('AverageCalculator')),
        'SocialMediaRepository' => create(SocialMediaRepository::class)->constructor(get('SocialMediaModelFactory')),
        'SocialMediaBlock' => create(SocialMediaBlock::class),
        'SocialMediaAll' => create(SocialMediaAll::class)->constructor(),

        'ApiConnection' => create(ApiConnection::class)->constructor(),
        'SocialRatingModel' => create(SocialRatingModel::class)->constructor(),
        'SocialRatingModelFactory' => create(SocialRatingModelFactory::class)->constructor(),
        'SocialRatingRepository' => create(SocialRatingRepository::class)->constructor(get('SocialRatingModelFactory'), get('ApiConnection'), get('SendDataUrl')),
        'SocialRatingAll' => create(SocialRatingAll::class)->constructor(),

        'Save' => create(Save::class)->constructor(get('Response'), get('SocialRatingModelFactory'), get('SocialRatingRepository')),
        'Delete' => create(Delete::class)->constructor(get('Response'), get('SocialRatingRepository')),

        'Rating' => create(Rating::class)->constructor(),
        'EditRating' => create(EditRating::class)->constructor(),

        SocialMedias::class => create(SocialMedias::class)
            ->constructor(get('Response'), get('SocialMediaRepository'), get('SocialMediaAll')),
        SocialRatings::class => create(SocialRatings::class)
            ->constructor(get('Response'), get('SocialRatingRepository'), get('SocialRatingAll')),
        GetSocialMedia::class => create(GetSocialMedia::class)
            ->constructor(get('Response'), get('SocialMediaRepository'), get('SocialMediaBlock')),
        AddRating::class => create(AddRating::class)
            ->constructor(get('Response'), get('Rating')),
        Update::class => create(Update::class)
            ->constructor(get('Response'),get('SocialRatingModelFactory'), get('EditRating'))
    ]
);

try {
    $container = $containerBuilder->build();
} catch (\Exception $e) {
    $e = 'Container build failed.';
}

$routes = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/social', SocialMedias::class);
    $r->addRoute('GET', '/social/{id:\d+}', GetSocialMedia::class);
    $r->addRoute('GET', '/ratings', SocialRatings::class);
    $r->addRoute('GET', '/rating', AddRating::class);
    $r->addRoute('GET', '/rating/edit/{id:\d+}', Update::class);

    $r->addRoute('POST', '/delete', 'Delete');
    $r->addRoute('POST', '/save', 'Save');

});

$middlewareQueue[] = new FastRoute($routes);
$middlewareQueue[] = new RequestHandler($container);

$requestHandler = new Relay($middlewareQueue);
$response = $requestHandler
    ->handle(ServerRequestFactory::fromGlobals());

$emitter = new SapiEmitter();

return $emitter->emit($response);