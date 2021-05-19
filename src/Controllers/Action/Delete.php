<?php
declare(strict_types=1);

namespace SocialApp\Controllers\Action;

use Psr\Http\Message\ResponseInterface;
use SocialApp\Repositories\SocialRatingRepository;

class Delete
{
    private ResponseInterface $response;

    private SocialRatingRepository  $repository;

    public function __construct(
        ResponseInterface $response,
        SocialRatingRepository $repository
    )
    {
        $this->response = $response;
        $this->repository = $repository;
    }

    public function __invoke(\Zend\Diactoros\ServerRequest $request): ResponseInterface
    {
        var_dump($request);
        exit;

        $this->repository->delete('Request Id goes here');

        header("Location: /ratings");
    }
}