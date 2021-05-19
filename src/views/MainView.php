<?php
declare(strict_types=1);

namespace SocialApp\views;


class MainView
{
    public function mainHtml(string $selectedView): string
    {
        return
            "<html lang='en'>
                <head><title></title></head>
                <body>If you see this it means the class with the body tag is working.
                " . $selectedView . "
                </body>
            </html>";
    }
}
