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

    /**
     * @throws MysqlException
     */
    public function getAllProducts(): ?array
    {
        $returnProducts = array();
        $products = $this->engine->getDb()->fetchRowMany(
            'SELECT * FROM products');
        if ($products == null)
            return null;
        foreach ($products as $product) {
            $returnProducts[] = new Product($product['id'], $product['cost'],
                $product['art'], $product['code'], $product['sold'], $product['balance'], $product['category'],
                json_decode($product['photos']));
        }
        return $returnProducts;
    }

    public function updateProduct(Product $product)
    {
        $this->engine->getDb()->update('products', ['id' => $product->getId()], [
            'cost' => $product->getCost(), 'art' => $product->getArt(), 'code' => $product->getCode(),
            'sold' => $product->getSold(), 'balance' => $product->getBalance(), 'category' => $product->getCategory(),
            'photos' => json_encode($product->getPhotos())
        ]);
    }

    /**
     * @throws MysqlException
     */
    public function createProduct(Product $product, $names, $descriptions): int
    {
        $id = $this->engine->getDb()->insert('products', [
            'cost' => $product->getCost(), 'art' => $product->getArt(), 'code' => $product->getCode(),
            'sold' => $product->getSold(), 'balance' => $product->getBalance(), 'category' => $product->getCategory(),
            'photos' => json_encode($product->getPhotos())
        ]);
        $this->engine->getSystem()->getLang()->addEditableRow("product-{$id}-name", $names);
        $this->engine->getSystem()->getLang()->addEditableRow("product-{$id}-description", $descriptions);

        return $id;
    }
}