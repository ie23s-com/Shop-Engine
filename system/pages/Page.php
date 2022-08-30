<?php

namespace ie23s\shop\system\pages;

abstract class Page
{
    private $name;
    private Pages $pages;

    /**
     * @param $name
     */
    public function __construct($name, Pages $pages)
    {
        $this->name = $name;
        $this->pages = $pages;

        $pages->loadModule($this);
    }

    public abstract function request(array $request): string;

    /**
     * @return mixed
     */
    public function getName()
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


}