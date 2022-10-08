<?php

namespace ie23s\shop\engine\utils\breadcrumbs\parameters;

use ie23s\shop\engine\utils\breadcrumbs\Engine;

require_once __SHOP_DIR__ . 'engine/parameters/ParameterType.enum.php';
require_once __SHOP_DIR__ . 'engine/parameters/Parameter.class.php';

class ParametersEngine
{
    private Engine $engine;

    /**
     * @param Engine $engine
     */
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }

}