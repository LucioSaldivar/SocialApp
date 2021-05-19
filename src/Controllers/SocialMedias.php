<?php
declare(strict_types=1);

namespace SocialApp\Controllers;

use SocialApp\Repositories\SocialMediaRepository;
use SocialApp\views\ListView\SocialMediaAll;
use Psr\Http\Message\ResponseInterface;

class SocialMedias
{
    private ResponseInterface $response;

    private SocialMediaRepository $repository;

    private SocialMediaAll $socialViews;

    public function __construct(
        ResponseInterface $response,
        SocialMediaRepository $repository,
        SocialMediaAll $socialViews
    )
    {
        $this->response = $response;
        $this->repository = $repository;
        $this->socialViews = $socialViews;
    }

    public function __invoke(): ResponseInterface
    {
        $socialModels = $this->repository->getAll();

        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()
            ->write(
                $this->socialViews->getHtml($socialModels),
            );

        return $response;
    }
}