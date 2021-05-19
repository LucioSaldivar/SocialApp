<?php
declare(strict_types=1);

namespace SocialApp\Model\Calculation;

use SocialApp\Repositories\SocialRatingRepository;

class AverageCalculator
{
    private SocialRatingRepository $ratingRepo;

    public function __construct(SocialRatingRepository $ratingRepo)
    {
        $this->ratingRepo = $ratingRepo;
    }

    /**
     * @param string $socialType
     * @return float
     * @throws \RuntimeException
     */
    public function calculateAverage(string $socialType): float
    {
        $list = $this->ratingRepo->getBySocialType($socialType);

        $count = count($list);
        $ratings = [];
        foreach ($list as $item) {
            $ratings[] = $item->getRating();
        }
        $sum = array_sum($ratings);
        if($sum === 0){
            throw new \RuntimeException("Cannot Divide by Zero");
        }

        return $sum / $count;
    }
}

