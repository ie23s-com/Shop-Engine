<?php

namespace ie23s\shop\system\pages;

//Component interface loader
require_once __SHOP_DIR__ . "system/pages/Theme.class.php";

use ie23s\shop\system\Component;
use ie23s\shop\system\System;

class Pages extends Component
{
    private $path;
    private Theme $theme;

    /**
     * @return void
     */
    public function init(System $system)
    {
        $this->setSystem($system);
        @       $this->path = $_GET['do'];
        $this->theme = new Theme();
        $this->theme->init($this);
    }

    /**
     * @return void
     */
    public function load()
    {
        $this->theme->load();
        $this->theme->addText("name", "Hello, Sasha!");
    }

    /**
     * @return void
     */
    public function unload()
    {
        echo $this->theme->getTpl('main');
    }
}