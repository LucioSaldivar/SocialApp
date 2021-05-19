<?php
declare(strict_types=1);

namespace SocialApp\Processors;

use SocialApp\Model\SocialRatingModel;

class SocialRatingModelFactory
{
    /**
     * @param array $item
     * @return SocialRatingModel
     */
    public function createObjectClass(array $item): SocialRatingModel
    {
        $model = new SocialRatingModel();
        $model->setId($item['id']);
        $model->setSocialType($item['socialType']);
        $model->setName($item['name']);
        $model->setComment($item['comment']);
        $model->setRating((int)$item['rating']);
        return $model;
    }
}