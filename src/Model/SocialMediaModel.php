<?php
declare(strict_types=1);

namespace SocialApp\Model;

class SocialMediaModel
{
    private string $id;

    private string $title;

    private string $url;

    private float $averageRating;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getAverage(): float
    {
        return $this->averageRating;
    }

    public function setAverage(float $averageRating): self
    {
        $this->averageRating = $averageRating;

        return $this;
    }



}