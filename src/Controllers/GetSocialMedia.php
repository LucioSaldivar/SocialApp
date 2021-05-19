<?php
declare(strict_types=1);

namespace SocialApp\Controllers;

use SocialApp\Repositories\SocialMediaRepository;
use SocialApp\views\ModelView\SocialMediaBlock;
use Psr\Http\Message\ResponseInterface;

class GetSocialMedia
{
    private ResponseInterface $response;

    private SocialMediaRepository $repository;

    private SocialMediaBlock $socialMediaBlock;

    public function __construct(
        ResponseInterface $response,
        SocialMediaRepository $repository,
        SocialMediaBlock $socialMediaBlock
    )
    {
        $this->response = $response;
        $this->repository = $repository;
        $this->socialMediaBlock = $socialMediaBlock;
    }

    public function __invoke($request): ResponseInterface
    {

        try {
            $socialModel = $this->repository->getById($request->getAttribute('id'));
            $result = $this->socialMediaBlock->getHtml($socialModel);
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