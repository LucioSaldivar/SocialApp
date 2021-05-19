<?php
declare(strict_types=1);

namespace SocialApp\views\ListView;

use SocialApp\Model\SocialRatingModel;
use SocialApp\views\MainView;

class SocialRatingAll extends MainView
{
    /**
     * @param SocialRatingModel[] $list
     * @return string
     */
    public function getHtml(array $list): string
    {
        $listItems = "";
        foreach ($list as $item) {
            $listItems .= "<tr>
                                <td>" . $item->getSocialType() . "</td>
                                <td>" . $item->getName() . "</td>
                                <td>" . $item->getComment() . "</td>
                                <td>" . $item->getRating() . "</td>
                                <td><a href='/rating/edit?id=".$item->getId()."'>Edit</a>
                                <a href='/delete?id=".$item->getId()."' >Delete</a></td>
                            </tr>";
        }
        return
            $this->mainHtml("<table>
                                            <tr>
                                            <th>Social Media Type</th>
                                            <th>Name</th>
                                            <th>Comment</th>
                                            <th>Rating</th>
                                            <th>Action</th>
                                            </tr>
                                            " . $listItems . "
                                        </table>"
            );
    }
}