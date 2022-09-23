<?php

namespace ie23s\shop\admin\api;
require_once __SHOP_DIR__ . 'admin/api/ApiAbstract.php';
require_once __SHOP_DIR__ . 'admin/api/ProductsApi.class.php';

use ie23s\shop\system\System;

class AdminApi
{
    private System $system;

    /**
     * @param System $system
     */
    public function __construct(System $system)
    {
        $this->system = $system;
    }

    public function loadApiMethods(): void
    {
        $this->system->getApi()->addPath('products', new ProductsApi($this->system));
    }
}