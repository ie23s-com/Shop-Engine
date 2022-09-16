<?php
namespace ie23s\shop\engine;

use ie23s\shop\engine\categories\CategoriesEngine;
use ie23s\shop\engine\parameters\ParametersEngine;
use ie23s\shop\engine\product\ProductEngine;
use ie23s\shop\system\Component;
use ie23s\shop\system\database\MySQLMod;
use ie23s\shop\system\System;
use Simplon\Mysql\Mysql;
use Simplon\Mysql\MysqlException;

require_once __SHOP_DIR__ . '/engine/categories/CategoriesEngine.class.php';
require_once __SHOP_DIR__ . '/engine/product/ProductEngine.class.php';

class Engine extends Component
{
    private MySQLMod $mySQLMod;
    private Mysql $db;

    private CategoriesEngine $categoriesEngine;
    private ProductEngine $productEngine;
    private ParametersEngine $parametersEngine;

    /**
     * @throws MysqlException
     */
    public function __construct(System $system)
    {
        parent::__construct($system);
        $this->mySQLMod = $system->getComponent('database');
    }

    /**
     * @throws MysqlException
     */
    public function load()
    {
        $this->db = $this->mySQLMod->getConn();
        $this->categoriesEngine = new CategoriesEngine($this);

        $this->productEngine = new ProductEngine($this);
        $this->parametersEngine = new ParametersEngine($this);
        $this->productEngine->load();
        $this->categoriesEngine->load();
    }

    /**
     * @return Mysql
     */
    public function getDb(): Mysql
    {
        return $this->db;
    }

    /**
     * @return CategoriesEngine
     */
    public function getCategoriesEngine(): CategoriesEngine
    {
        return $this->categoriesEngine;
    }

    /**
     * @return ProductEngine
     */
    public function getProductEngine(): ProductEngine
    {
        return $this->productEngine;
    }


}