<?php
declare(strict_types=1);

namespace SocialApp\Controllers;

use SocialApp\Repositories\SocialRatingRepository;
use SocialApp\views\ListView\SocialRatingAll;
use Psr\Http\Message\ResponseInterface;

class SocialRatings
{
    private ResponseInterface $response;

    private SocialRatingRepository $repository;

    private SocialRatingAll $ratingView;

    public function __construct(
        ResponseInterface $response,
        SocialRatingRepository $repository,
        SocialRatingAll $ratingView
    )
    {
        $this->response = $response;
        $this->repository = $repository;
        $this->ratingView = $ratingView;
    }

    public function __invoke(): ResponseInterface
    {
        try {
            $ratingModels = $this->repository->getAll();
            $result = $this->ratingView->getHtml($ratingModels);
        } catch (\MyException $ex) {
            $result = "Failed to get list of Social Medias";
        } catch (\Exception $ex){
            $result = "Custom exception also failed.";
        }
        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()
            ->write($result);
        return $response;
    }
}