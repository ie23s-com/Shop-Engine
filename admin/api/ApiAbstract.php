<?php

namespace ie23s\shop\admin\api;

use ie23s\shop\engine\Engine;
use ie23s\shop\system\api\ApiInterface;
use ie23s\shop\system\System;

abstract class ApiAbstract implements ApiInterface
{
    private System $system;
    private Engine $engine;
    private int $code = 200;

    /**
     * @param System $system
     */
    public function __construct(System $system)
    {
        $this->system = $system;
        $this->engine = $system->getEngine();
    }

    /**
     * @return System
     */
    public function getSystem(): System
    {
        return $this->system;
    }

    /**
     * @return Engine
     */
    public function getEngine(): Engine
    {
        return $this->engine;
    }

    public function code(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

}