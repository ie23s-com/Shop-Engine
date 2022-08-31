<?php

namespace ie23s\shop\engine\product;

require_once __SHOP_DIR__ . '/engine/product/Product.class.php';
require_once __SHOP_DIR__ . '/engine/product/ProductPage.class.php';

use ie23s\shop\engine\Engine;
use ie23s\shop\system\pages\Pages;
use Simplon\Mysql\MysqlException;

class ProductEngine
{
    private Engine $engine;
    private Pages $pages;

    /**
     * @param Engine $engine
     */
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
        $this->pages = $this->engine->getSystem()->getComponent('pages');
    }

    public function load()
    {
        (new ProductPage('product', $this->pages))->load($this);
    }

    /**
     * @throws MysqlException
     */
    public function getProductById($id): ?Product
    {
        $product = $this->engine->getDb()->fetchRow(
            'SELECT * FROM products WHERE id = :id', array('id' => $id));
        if ($product == null)
            return null;
        return new Product($product['id'], $product['cost'],
            $product['art'], $product['code'], $product['sold'], $product['balance'], $product['category'],
            json_decode($product['photos']));
    }
}