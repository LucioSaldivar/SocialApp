<?php
declare(strict_types=1);

namespace SocialApp\Repositories;

use SocialApp\Model\SocialRatingModel;
use SocialApp\Processors\SocialRatingModelFactory;
use SocialApp\Setup\ApiConnection;
use UnexpectedValueException;

class SocialRatingRepository
{
    private SocialRatingModelFactory $factory;

    private ApiConnection $apiConnection;

    public function __construct(SocialRatingModelFactory $factory, ApiConnection $apiConnection)
    {
        $this->factory = $factory;
        $this->apiConnection = $apiConnection;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $result = [];
        foreach ($this->apiConnection->apiConn() as $item) {
            $result[] = $this->factory->createObjectClass($item);
        }
        return $result;
    }

    /**
     * @param string $id
     * @return SocialRatingModel
     * @throws UnexpectedValueException
     */
    public function getById(string $id): SocialRatingModel
    {
        foreach ($this->getAll() as $item) {
            if ($item->getId() == $id) {
                return $item;
            }
        }
        throw new UnexpectedValueException('No such Value in Database');
    }

    /**
     * @param string $title
     * @return SocialRatingModel
     * @throws UnexpectedValueException
     */
    public function getByTitle(string $title): SocialRatingModel
    {
        foreach ($this->getAll() as $item) {
            if ($item->getTitle() == $title) {
                return $item;
            }
        }
        throw new UnexpectedValueException('No such Value in Database');
    }

    /**
     * @param string $socialType
     * @return SocialRatingModel[]
     */
    public function getBySocialType(string $socialType): array
    {
        $result = [];
        foreach ($this->getAll() as $item) {
            if ($item->getSocialType() === $socialType) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @param SocialRatingModel $model
     * @param $reqType
     * @return array
     *
     * Use Api to save model here.
     */
    public function save(SocialRatingModel $model, $reqType)
    {
       $socialType = $model->getSocialType();
       $name = $model->getName();
       $comment = $model->getComment();
       $rating = $model->getRating();

       $ary = compact('socialType','name','comment','rating');

        if($reqType === "PUT"){
           return $this->apiConnection->cUrlUpdate($model->getId(), $ary);
        } else {
            return $this->apiConnection->cUrlPost($ary);
        }
    }

    public function delete($id)
    {
        $this->apiConnection->cUrlDelete($id);
    }
}
