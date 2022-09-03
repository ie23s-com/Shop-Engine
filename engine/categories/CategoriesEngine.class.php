<?php

namespace ie23s\shop\engine\categories;

use Category;
use ie23s\shop\engine\Engine;
use Simplon\Mysql\MysqlException;

class CategoriesEngine
{

    private Engine $engine;

    private array $categories = array();

    /**
     * @param Engine $engine
     * @throws MysqlException
     */
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;

        $cursor = $this->engine->getDb()->FetchColumnManyCursor('SELECT * FROM categories');

        foreach ($cursor as $result) {
            $this->categories[$result['id']] =
                new Category($result['id'], $result['name'], $result['parent'], $result['parameters'],
                    $engine->getSystem()->getLang()->getEditableRow("category-{$result['id']}-name"));
        }
    }

    /**
     * @param int $id
     * @return Category
     */
    public function getCategory(int $id): Category
    {
        return $this->categories[$id];
    }


}