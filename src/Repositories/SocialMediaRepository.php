<?php
declare(strict_types=1);

namespace SocialApp\Repositories;

use SocialApp\Model\SocialMediaModel;
use SocialApp\Processors\SocialMediaModelFactory;

class SocialMediaRepository
{
    private SocialMediaModelFactory $mediaModelFactory;

    const SOCIALDATA = [
        [
            'id' => '1',
            'title' => 'Twitter',
            'url' => 'www.twitter.com',
        ],
        [
            'id' => '2',
            'title' => 'Facebook',
            'url' => 'www.facebook.com',
        ],
        [
            'id' => '3',
            'title' => 'Instagram',
            'url' => 'www.instagram.com',
        ],
    ];

    public function __construct(
        SocialMediaModelFactory $mediaModelFactory
    )
    {
        $this->mediaModelFactory = $mediaModelFactory;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $result = [];
        foreach (self::SOCIALDATA as $item) {
            $result[] = $this->mediaModelFactory->createObjectClass($item);
        }
        return $result;
    }

    /**
     * @param string $id
     * @return SocialMediaModel
     * @throws UnexpectedValueException
     */
    public function getById(string $id): SocialMediaModel
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
     * @return SocialMediaModel
     * @throws OutOfBoundsException
     */
    public function getByTitle(string $title): SocialMediaModel
    {
        foreach ($this->getAll() as $item) {
            if ($item->getTitle() == $title) {
                return $item;
            }
        }
        throw new \OutOfBoundsException('Cant find Specific Social Media.');
    }

    /**
     * @return array
     */
    public function getTitles(): array
    {
        $titles = [];
        foreach (self::SOCIALDATA as $item) {
            $titles[] = $item['title'];
        }

        return $titles;
    }
//    public function save()
//    {
//
//}
//
//    public function delete()
//    {
//
//}
}