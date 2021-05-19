<?php
declare(strict_types=1);

namespace SocialApp\Controllers\Action;

use SocialApp\views\Forms\EditRating;
use SocialApp\Processors\SocialRatingModelFactory;
use Psr\Http\Message\ResponseInterface;

class Update
{
    private ResponseInterface $response;

    private SocialRatingModelFactory $factory;

    private EditRating $ratingView;

    public function __construct(
        ResponseInterface $response,
        SocialRatingModelFactory $factory,
        EditRating $ratingView
    )
    {
        $this->response = $response;
        $this->factory = $factory;
        $this->ratingView = $ratingView;
    }

    public function __invoke(\Zend\Diactoros\ServerRequest $request): ResponseInterface
    {
        $rating = $this->factory->createObjectClass($request->getParsedBody());

        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()
            ->write($this->ratingView->getHtml($rating));

        return $response;
    }
}