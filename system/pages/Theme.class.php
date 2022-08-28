<?php

namespace ie23s\shop\system\pages;

use Smarty;

class Theme
{
    private $texts = array();
    private $params = array();
    private $blocks = array();

    private $theme;
    private Smarty $smarty;

    /**
     * @return void
     */
    public function init(Pages $pages)
    {
        $this->theme = $_ENV['THEME'];
    }

    /**
     * @return void
     */
    public function load()
    {
        $this->smarty = new Smarty();

        $this->smarty->setTemplateDir(__SHOP_DIR__ . 'templates/' . $this->theme);

        $this->smarty->caching = false; //OFF Cache
    }

    /**
     * Returns ready theme
     *
     * @param string $name - name of tpl file
     * @return String
     */
    public function getTpl(string $name): string
    {
        $this->smarty->assign($this->blocks);
        $this->smarty->assign($this->params);
        $this->smarty->assign($this->texts);

        return $this->smarty->fetch("{$name}.tpl");
    }

    /**
     * @return Smarty
     */
    public function getSmarty(): Smarty
    {
        return $this->smarty;
    }

    /**
     * @param string $name
     * @param string $block
     */
    public function addBlock(string $name, string $block)
    {
        $this->blocks[$name] = $block;
    }

    /**
     * @param string $name
     * @param string $text
     */
    public function addText(string $name, string $text)
    {
        $this->texts[$name] = $text;
    }

    /**
     * @param string $name
     * @param string $blocks
     */
    public function addParam(string $name, string $param)
    {
        $this->params[$name] = $param;
    }

}