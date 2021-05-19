<?php
declare(strict_types=1);

namespace SocialApp\Processors;

use SocialApp\Model\SocialMediaModel;
use SocialApp\Model\Calculation\AverageCalculator;

class SocialMediaModelFactory
{
    private AverageCalculator $calculator;

    public function __construct(AverageCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @param array $item
     * @return SocialMediaModel
     */
    public function createObjectClass(array $item): SocialMediaModel
    {
        $model = new SocialMediaModel();
        $model->setId($item['id']);
        $model->setTitle($item['title']);
        $model->setUrl($item['url']);
        $model->setAverage($this->calculator->calculateAverage($item['id']));

        return $model;
    }
}