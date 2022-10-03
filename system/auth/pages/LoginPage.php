<?php

namespace ie23s\shop\system\auth\pages;

use ie23s\shop\system\pages\Page;
use ie23s\shop\system\pages\Theme;

class LoginPage extends Page
{

    public function request(array $request): string
    {
        $theme = new Theme();

        if(isset($request[1]) && $request[1] == 'tonly'){
            $this->needTheme(false);
        }
        return $theme->getTpl('auth/login');
    }
}