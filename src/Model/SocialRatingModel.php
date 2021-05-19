<?php
declare(strict_types=1);

namespace SocialApp\Model;

class SocialRatingModel
{
    private string $id;

    private string $socialType;

    private string $name;

    private string $comment;

    private int $rating;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getSocialType(): string
    {
        return $this->socialType;
    }

    public function setSocialType(string $socialType): self
    {
        $this->socialType = $socialType;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function setRating($rating): self
    {
        $this->rating = $rating;
        return $this;
    }
}