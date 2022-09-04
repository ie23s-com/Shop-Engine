<?php

namespace ie23s\shop\admin\pages;

require_once __SHOP_DIR__ . 'admin/pages/AdminPage.php';
require_once __SHOP_DIR__ . 'admin/pages/Categories.class.php';
require_once __SHOP_DIR__ . 'admin/pages/MainPage.class.php';

use ie23s\shop\system\pages\Page;
use ie23s\shop\system\pages\Theme;
use Simplon\Mysql\MysqlException;
use SmartyException;

class Pages extends Page
{
    private array $request;
    private array $modules;

    private Theme $theme;

    /**
     * @throws SmartyException
     * @throws MysqlException
     */
    public function request(array $request): string
    {

        if(@$_GET['admin'] != 'ok') {
            $this->getPages()->error(403, "Forbidden");
        }
        $this->request = $request;
        $this->loadModules();

        $this->theme = new Theme();
        $this->loadButtons();
        $this->theme->addBlock('admin_content', $this->getCurrentPage()->getPage());
        return $this->theme->getTpl('admin/admin');

    }

    /**
     * @throws MysqlException
     */
    private function loadModules() {
        $this->modules['main'] = new MainPage($this->getPages()->getSystem(), 'admin_menu_main',
            '/administrator/?admin=ok');
        $this->modules['categories'] = new Categories($this->getPages()->getSystem(), 'admin_menu_categories',
            '/administrator/categories/?admin=ok');
    }

    private function getCurrentPage() {
        if(!isset($this->request[1]))
            $this->request[1] = 'main';
        $page = $this->request[1];
        if(!isset($this->modules[$page]))
            $this->getPages()->error(404, "Not found!");
        return $this->modules[$page];

    }

    private function loadButtons() {

        $buttons = array();
        /** @var AdminPage $module */
        foreach ($this->modules as $module){

            $buttons[] = array('name' => $module->getName(), 'uri' => $module->getUri());
        }
        $this->theme->addArray('admin_buttons', $buttons);
    }
}