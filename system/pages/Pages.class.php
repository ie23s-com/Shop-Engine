<?php

namespace ie23s\shop\system\pages;

//Component interface loader
require_once __SHOP_DIR__ . "system/pages/Theme.class.php";
//Page component
require_once __SHOP_DIR__ . "system/pages/Page.php";
require_once __SHOP_DIR__ . "system/pages/ErrorPage.class.php";

use ie23s\shop\system\Component;
use ie23s\shop\system\System;
use Simplon\Mysql\MysqlException;
use SmartyException;

class Pages extends Component
{
    private array $path = array();
    private Theme $theme;
    private string $title;

    private array $modules = array();
    private array $pathsModules = [];

    private ErrorPage $errorPage;

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


        $this->errorPage = (new ErrorPage('error', $this, 'error'));

    }

    /**
     * @return void
     * @throws MysqlException
     */
    public function load()
    {

        $this->title = $this->getSystem()->getLang()->getRow('title');
        $this->theme->addBlock("theme_path", __SHOP_DIR__ . 'templates/' . $this->theme->getThemeName());
        $this->theme->addBlock("time", time());

    }

    private function getModule(): Page
    {
        if (!isset($this->path[0]) || empty($this->path[0])) {
            $this->path[0] = 'index';
        }
        $name = $this->pathsModules[$this->path[0]] ?? null;
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
        $this->theme->addBlock('content', $this->getModule()->request($this->path));
        $this->theme->addBlock("title", $this->title);
        echo $this->theme->getTpl('main');
    }

    public function loadModule(Page $page)
    {
        foreach ($page->getPaths() as $path) {
            if(isset($this->pathsModules[$path])) {
                $this->error(503, "Conflict modules! Module [{$page->getName()}] is going to reserve
                path '$path' which used by {$this->pathsModules[$path]}!");
            }
            $this->pathsModules[$path] = $page->getName();
        }
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
     */
    public function error($num, $text = "")
    {
        $this->title = "{$num} error";
        $this->path[0] = 'error';
        $this->errorPage->setError($num, $text);
    }

}