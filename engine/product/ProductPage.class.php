<?php

namespace ie23s\shop\engine\product;

use ie23s\shop\system\pages\Page;
use ie23s\shop\system\pages\Theme;
use Simplon\Mysql\MysqlException;
use SmartyException;

class ProductPage extends Page
{
    private ProductEngine $productEngine;

    /**
     * @param array $request
     * @return string
     * @throws MysqlException
     * @throws SmartyException
     */
    public function request(array $request): string
    {
        $product = $this->productEngine->getProductById($request[1]);
        if ($product == null)
            $this->getPages()->error(404, "This product not found");
        $theme = new Theme();
        $theme->addBlock('product_name', $this->getLang()->getEditableRow("product-name", $product->getId()));
        $theme->addBlock('product_description', $this->getLang()->
        getEditableRow("product-description", $product->getId()));
        $theme->addBlock('product_cost', $product->getCost());
        $theme->addBlock('product_art', $product->getArt());
        $this->getPages()->setTitle($this->getLang()->getEditableRow("product-name", $product->getId()));
        return $theme->getTpl('product');
    }

    public function load(ProductEngine $param)
    {
        $this->productEngine = $param;
    }
}