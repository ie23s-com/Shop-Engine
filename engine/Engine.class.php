<?php
namespace ie23s\shop\engine;

use ie23s\shop\engine\product\ProductEngine;
use ie23s\shop\system\Component;
use ie23s\shop\system\database\MySQLMod;
use ie23s\shop\system\System;
use Simplon\Mysql\Mysql;

require_once __SHOP_DIR__ . '/engine/product/ProductEngine.class.php';

class Engine extends Component
{
    private MySQLMod $mySQLMod;
    private Mysql $db;

    private ProductEngine $productEngine;

    public function __construct(System $system)
    {
        parent::__construct($system);
        $this->mySQLMod = $system->getComponent('database');

        $this->productEngine = new ProductEngine($this);
    }

    public function load()
    {
        $this->db = $this->mySQLMod->getConn();
        $this->productEngine->load();
    }

    /**
     * @return Mysql
     */
    public function getDb(): Mysql
    {
        return $this->db;
    }
}