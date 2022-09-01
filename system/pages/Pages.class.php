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
            $this->path = self::fromPath($_GET['do']);
        }
        $this->theme = new Theme();

    }

    /**
     * @return void
     */
    public function load()
    {
        $this->mySQL = $this->getSystem()->getComponent('database');

        $this->title = $this->getSystem()->getLang()->getRow('title');

    }

    /**
     * @throws SmartyException
     */
    private function getModule(): Page
    {
        if (!isset($this->path[0]) || empty($this->path[0])) {
            $this->path[0] = 'index';
        }
        $name = $this->mySQL->getConn()->fetchColumn("SELECT `module`
                                                        FROM `pages`
                                                        WHERE  `path` = :path", ['path' => $this->path[0]]);
        if ($name == null)
            $this->error(404, 'Not found. Please, try to find other page!');
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
        $this->theme->addBlock('content', $this->getModule()->request($this->path));
        echo $this->theme->getTpl('main');
    }

    public function loadModule(Page $page)
    {
        $this->modules[$page->getName()] = $page;
    }

    /**
     * @return array
     */
    public function getPath(): array
    {
        return $this->path;
    }

    public static function fromPath(string $path): array
    {
        $do = preg_replace('|(/+)|', '/', trim($path, '/'));
        return explode('/', $do);
    }

    public static function toPath(array $array): string
    {
        return implode('/', $array);
    }

    /**
     * @return void
     * @throws SmartyException
     */
    public function error($num, $text = "")
    {
        $this->path[0] = 'error';

        (new ErrorPage('error', $this))->setError($num, $text);
    }

}