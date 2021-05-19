<?php
declare(strict_types=1);

namespace SocialApp\views\ModelView;

use SocialApp\Model\SocialMediaModel;
use SocialApp\views\MainView;

class SocialMediaBlock extends MainView
{
    public function getHtml(SocialMediaModel $socialMediaModel): string
    {
        return
            $this->mainHtml("<form>
                                            <h1>" . $socialMediaModel->getTitle() . "</h1>
                                            <p>This social media has an id of: " . $socialMediaModel->getId() . "</p>
                                            <p>Link to this social media is: " . $socialMediaModel->getUrl() . "</p>
                                        </form>"
            );
    }
}