<?php

namespace ie23s\shop\engine\utils\breadcrumbs\product;

require_once __SHOP_DIR__ . '/engine/product/Product.class.php';
require_once __SHOP_DIR__ . '/engine/product/ProductPage.class.php';

use ie23s\shop\engine\utils\breadcrumbs\Engine;
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
        (new ProductPage('product', $this->pages, 'product'))->load($this->engine);
    }

    /**
     * @throws MysqlException
     */
    public function getProductById($id): ?Product
    {
        $product = $this->engine->getDb()->fetchRow(
            'SELECT *, (SELECT language_editable.value
                        FROM language_editable
                        WHERE language_editable.`type` = \'product-name\' AND `external_id` = :id
                        AND lang_id = :lang_id)
                            as display_name,
                        (SELECT language_editable.value
                        FROM language_editable
                        WHERE language_editable.`type` = \'product-description\' AND `external_id` = :id
                        AND lang_id = :lang_id)
                            as description
                    FROM products WHERE id = :id', array('id' => $id, 'lang_id' => 1));
        if ($product == null)
            return null;
        return new Product($product['id'], $product['cost'],
            $product['art'], $product['code'], $product['sold'], $product['balance'], $product['category'],
            json_decode($product['photos']), $product['display_name'], $product['description']);

    }

    /**
     * @throws MysqlException
     */
    public function getProductByIdAsArray($id): array
    {
        return $this->engine->getDb()->fetchRow(
            'SELECT *, (SELECT language_editable.value
                        FROM language_editable
                        WHERE language_editable.`type` = \'product-name\' AND `external_id` = :id
                        AND lang_id = :lang_id)
                            as display_name,
                        (SELECT language_editable.value
                        FROM language_editable
                        WHERE language_editable.`type` = \'product-description\' AND `external_id` = :id
                        AND lang_id = :lang_id)
                            as description
                    FROM products WHERE id = :id', array('id' => $id, 'lang_id' => 1));

    }

    /**
     * @throws MysqlException
     */
    public function getAllProducts(int $category = null): array
    {
        $returnProducts = array();

        $products = $this->engine->getDb()->fetchRowMany(
            'SELECT *, (SELECT language_editable.value
                        FROM language_editable
                        WHERE language_editable.`type` = \'product-name\' AND `external_id` = products.id
                        AND lang_id = :lang_id)
                            as display_name,
                        (SELECT language_editable.value
                        FROM language_editable
                        WHERE language_editable.`type` = \'product-description\' AND `external_id` = products.id
                        AND lang_id = :lang_id)
                            as description
                    FROM products WHERE category LIKE CONCAT(\'%\', :category) ORDER BY `id` DESC',
            array('lang_id' => 1, 'category' => $category ?? ''));
        if ($products == null)
            return [];
        foreach ($products as $product) {
            $returnProducts[] = new Product($product['id'], $product['cost'],
                $product['art'], $product['code'], $product['sold'], $product['balance'], $product['category'],
                json_decode($product['photos']), $product['display_name'], $product['description']);
        }
        return $returnProducts;
    }

    public function updateProduct(Product $product, $names, $descriptions)
    {
        $this->engine->getDb()->update('products', ['id' => $product->getId()], [
            'cost' => $product->getCost(), 'art' => $product->getArt(), 'code' => $product->getCode(),
            'sold' => $product->getSold(), 'balance' => $product->getBalance(), 'category' => $product->getCategory(),
            'photos' => json_encode($product->getPhotos())
        ]);
        $this->engine->getSystem()->getLang()->editEditableRow('product-name', $product->getId(), $names);
        $this->engine->getSystem()->getLang()->editEditableRow("product-description", $product->getId(),
            $descriptions);

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
        $this->engine->getSystem()->getLang()->addEditableRow('product-name', $id, $names);
        $this->engine->getSystem()->getLang()->addEditableRow("product-description", $id, $descriptions);

        return $id;
    }

    public function removeProduct(?Product $product)
    {
        $this->engine->getDb()->delete('products', ['id' => $product->getId()]);
        $this->engine->getSystem()->getLang()->deleteEditableRow('product-name', $product->getId());
        $this->engine->getSystem()->getLang()->deleteEditableRow('product-description', $product->getId());
    }
}