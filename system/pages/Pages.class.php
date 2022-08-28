<?php

namespace ie23s\shop\system\pages;

use ie23s\shop\system\Component;

class Pages implements Component
{
    private $path;
    private $system;
    private $theme;

    /**
     * @return mixed
     */
    public function init($system)
    {
        $this->path = $_GET['do'];
        $this->system = $system;
        $this->theme = new Theme();
        $this->theme->init($this);
    }

    /**
     * @return mixed
     */
    public function load()
    {
        // TODO: Implement load() method.
    }

    /**
     * @return mixed
     */
    public function unload()
    {
        // TODO: Implement unload() method.
    }
}