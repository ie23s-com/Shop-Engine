<?php

namespace ie23s\shop\admin\api;

class ProductsApi extends ApiAbstract
{
    /**
     * @return string
     */
    public function get(): string
    {
        return 1;
    }

    /**
     * @return string
     */
    public function post(): string
    {
        $this->setCode(400);
        return json_encode(['error' => '400', 'text' => 'Bad Request']);
    }

    /**
     * @return string
     */
    public function put(): string
    {
        return 1;
    }

    /**
     * @return string
     */
    public function delete(): string
    {
        return 1;
    }
}