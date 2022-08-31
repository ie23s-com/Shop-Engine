<?php

namespace ie23s\shop\system\pages;

use ie23s\shop\system\lang\Lang;

abstract class Page
{
    private string $name;
    private Pages $pages;
    private Lang $lang;

    /**
     * @param $name
     */
    public function __construct($name, Pages $pages)
    {
        $this->name = $name;
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


}