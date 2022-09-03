<?php

class Category
{
    private int $id;
    private string $name;
    private int $parent_id;
    private array $params;

    private string $display_name;

    /**
     * @param int $id
     * @param string $name
     * @param int $parent_id
     * @param array $params
     * @param string $display_name
     */
    public function __construct(int $id, string $name, int $parent_id, array $params, string $display_name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parent_id = $parent_id;
        $this->params = $params;
        $this->display_name = $display_name;
    }


}