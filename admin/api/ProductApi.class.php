<?php

namespace ie23s\shop\admin\api;

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
        return $this->withCode(405);
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