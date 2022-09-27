<?php

namespace ie23s\shop\system\auth\pages;

use ie23s\shop\system\pages\Page;
use ie23s\shop\system\pages\Theme;

class RegisterPage extends Page
{

    public function request(array $request): string
    {
        $theme = new Theme();
        return $theme->getTpl('register');
    }
}