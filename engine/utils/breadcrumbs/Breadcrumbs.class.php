<?php

namespace ie23s\shop\engine\utils\breadcrumbs;


require_once __SHOP_DIR__ . '/engine/utils/breadcrumbs/BreadcrumbModel.php';

class Breadcrumbs
{
    private array $list = [];
    private int $current = -1;

    public function next(): bool
    {

        return isset($this->list[++$this->current]);

    }

    public function prev(): bool
    {

        return isset($this->list[++$this->current]);
    }

    public function get(): ?BreadcrumbModel
    {

        return $this->list[$this->current];
    }

    public function add(BreadcrumbModel $model)
    {
        $this->list[] = $model;
    }
}