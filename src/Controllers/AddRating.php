<?php
declare(strict_types=1);

namespace SocialApp\Controllers;

use SocialApp\views\Forms\Rating;
use Psr\Http\Message\ResponseInterface;

class AddRating
{
    private ResponseInterface $response;

    private Rating $ratingView;

    public function __construct(
        ResponseInterface $response,
        Rating $ratingView
    )
    {
        $this->response = $response;
        $this->ratingView = $ratingView;
    }


    public function __invoke(): ResponseInterface
    {
        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()
            ->write($this->ratingView->getHtml());
        return $response;
    }
}