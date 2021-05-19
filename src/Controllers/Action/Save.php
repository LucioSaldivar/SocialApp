<?php
declare(strict_types=1);

namespace SocialApp\Controllers\Action;

use SocialApp\Processors\SocialRatingModelFactory;
use SocialApp\Repositories\SocialRatingRepository;

use Psr\Http\Message\ResponseInterface;

class Save
{
    private ResponseInterface $response;

    private SocialRatingModelFactory $factory;

    private SocialRatingRepository  $repository;

    public function __construct(
        ResponseInterface $response,
        SocialRatingModelFactory $factory,
        SocialRatingRepository $repository
    )
    {
        $this->response = $response;
        $this->factory = $factory;
        $this->repository = $repository;
    }

    public function __invoke(\Zend\Diactoros\ServerRequest $request): ResponseInterface
    {


        $reqType = $request->getMethod();
        $obj = $this->factory->createObjectClass($request->getParsedBody());

        $this->repository->save($obj,$reqType);

        header('Location: /ratings');

        throw new \UnexpectedValueException('Failed at Save.php __invoke function');
    }
}