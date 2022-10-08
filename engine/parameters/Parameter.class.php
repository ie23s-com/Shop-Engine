<?php

namespace ie23s\shop\engine\utils\breadcrumbs\parameters;

class Parameter
{
    private int $id;
    private string $display_name;
    private string $display_value;

    private ParameterType $type;

    /**
     * @param int $id
     * @param string $display_name
     * @param string $display_value
     * @param mixed $type
     */
    public function __construct(int $id, string $display_name, string $display_value, $type)
    {
        $this->id = $id;
        $this->display_name = $display_name;
        $this->display_value = $display_value;
        $this->type = ParameterType::from($type);
    }


}