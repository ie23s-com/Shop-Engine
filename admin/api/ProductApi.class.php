<?php

namespace ie23s\shop\admin\api;

use ie23s\shop\engine\product\Product;
use ie23s\shop\engine\product\ProductEngine;
use ie23s\shop\system\System;
use Simplon\Mysql\MysqlException;

class ProductApi extends ApiAbstract
{
    private ProductEngine $productEngine;
    public function __construct(System $system)
    {
        parent::__construct($system);
        $this->productEngine = $system->getEngine()->getProductEngine();
    }

    public function get(): string
    {
        return $this->withCode(405);
    }

    public function post(): string
    {
        $product = new Product(0, $this->getRequest('cost'), $this->getRequest('art'),
            $this->getRequest('code'), $this->getRequest('sold'),
            $this->getRequest('balance'), $this->getRequest('category'));
        $names = [['lang_id' => 1, 'value' => $this->getRequest('display_name')]];
        $descs = [['lang_id' => 1, 'value' => $this->getRequest('description')]];
        try {
            $this->productEngine->createProduct($product, $names, $descs);
        } catch (MysqlException $e) {
            return $this->withCode(500);
        }
        return $this->withCode(200, json_encode(['id'=>$product->getId()]));
    }

    public function put(): string
    {
        return $this->withCode(405);
    }

    public function delete(): string
    {
        try {
            $product = $this->productEngine->getProductById($this->getRequest('id'));
            if($product == null) {
                return $this->withCode(404);
            }
            $this->productEngine->removeProduct($product);
            return $this->withCode(200);
        } catch (MysqlException $e) {
            return $this->withCode(500);
        }
    }
}