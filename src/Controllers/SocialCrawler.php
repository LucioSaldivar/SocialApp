<?php
declare(strict_types=1);

namespace SocialApp\Controllers;

use SocialApp\Repositories\SocialMediaRepository;
use SocialApp\Observers\CrawlerObserver;
use Psr\Http\Message\ResponseInterface;
use Spatie\Crawler\Crawler;


class SocialCrawler
{
    private SocialMediaRepository $db;

    private CrawlerObserver $crawler;

    private ResponseInterface $response;

    public function __construct(
        ResponseInterface $response
    )
    {
        $this->db = new SocialMediaRepository();
        $this->crawler = new CrawlerObserver();
        $this->response = $response;
    }

    public function handleCrawl()
    {
        Crawler::create()
            ->setCrawlObserver($this->crawler)
            ->startCrawling($this->db->fetchByUrl());
    }


    public function __invoke(): ResponseInterface
    {
        $response = $this->response->withHeader('Content-Type', 'text/html');
        $response->getBody()
            ->write("<html>
<head></head>
<body>Hello, world! This data: {$this->handleCrawl()} </body>
</html>");

        return $response;
    }
}