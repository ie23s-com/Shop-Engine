<?php

namespace ie23s\shop\system\pages;

//Component interface loader
require_once __SHOP_DIR__ . "system/pages/Theme.class.php";

use ie23s\shop\system\Component;
use Simplon\Mysql\MysqlException;
use SmartyException;

class Pages extends Component
{
    private string $path;
    private Theme $theme;

    /**
     * @return void
     */
    public function init()
    {
        $this->path = $_GET['do'] ?? '';
        $this->theme = new Theme();
        $this->theme->init($this);
    }

    /**
     * @return void
     * @throws MysqlException
     */
    public function load()
    {
        $this->theme->load();
        $this->theme->addText("title", $this->getSystem()->getLang()->getRow('title'));
    }

    /**
     * @return void
     * @throws SmartyException
     */
    public function unload()
    {
        echo $this->theme->getTpl('main');
    }
}