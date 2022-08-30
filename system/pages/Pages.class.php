<?php

namespace ie23s\shop\system\pages;

//Component interface loader
require_once __SHOP_DIR__ . "system/pages/Theme.class.php";
//Page component
require_once __SHOP_DIR__ . "system/pages/Page.php";
require_once __SHOP_DIR__ . "system/pages/ErrorPage.class.php";

use ie23s\shop\system\Component;
use ie23s\shop\system\System;
use SmartyException;

class Pages extends Component
{
    private array $path = array();
    private Theme $theme;
    private string $title;

    private array $modules = array();
    private Component $mySQL;

    /**
     * @return void
     */
    public function __construct(System $system)
    {
        parent::__construct($system);
        if (isset($_GET['do'])) {
            $this->path = self::getPath($_GET['do']);
        }

    }

    /**
     * @return void
     */
    public function load()
    {
        $this->theme = new Theme();
        $this->mySQL = $this->getSystem()->getComponent('database');

        new ErrorPage('error', $this);
        $this->title = $this->getSystem()->getLang()->getRow('title');
        $this->theme->addBlock('content', $this->getModule()->request($this->path));
    }

    private function getModule(): Page
    {

        $name = $this->mySQL->getConn()->fetchColumn("SELECT `module`
                                                        FROM `pages`
                                                        WHERE  `path` = :path", ['path' => $this->path[0]]);
        return $this->modules[$name];
    }

    /**
     */
    public function setTitle(string $title)
    {
        $this->title .= ' - ' . $title;
    }

    /**
     * @return void
     * @throws SmartyException
     */
    public function unload()
    {
        $this->theme->addText("title", $this->title);
        echo $this->theme->getTpl('main');
    }

    public function loadModule(Page $page)
    {
        $this->modules[$page->getName()] = $page;
    }

    public static function getPath(string $path): array
    {
        $do = preg_replace('|(/+)|', '/', trim($path, '/'));
        return explode('/', $do);
    }

    public static function toPath(array $array): string
    {
        return implode('/', $array);
    }
}