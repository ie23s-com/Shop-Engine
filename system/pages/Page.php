<?php

namespace ie23s\shop\system\pages;

use ie23s\shop\system\lang\Lang;
use ie23s\shop\system\System;

abstract class Page
{
    private string $name;
    private Pages $pages;
    private Lang $lang;
    private array $paths;

    /**
     * @param $name
     * @param array $paths
     * @param Pages $pages
     */
    public function __construct($name, array $paths, Pages $pages)
    {
        $this->name = $name;
        $this->paths = $paths;
        $this->pages = $pages;
        $this->lang = $pages->getSystem()->getLang();

        $pages->loadModule($this);
    }

    public abstract function request(array $request): string;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Pages
     */
    public function getPages(): Pages
    {
        return $this->pages;
    }

    /**
     * @return Lang
     */
    public function getLang(): Lang
    {
        return $this->lang;
    }

    public function getSystem(): System
    {
        return $this->pages->getSystem();
    }

    /**
     * @return array
     */
    public function getPaths(): array
    {
        return $this->paths;
    }

}