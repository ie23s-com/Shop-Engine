<?php

namespace ie23s\shop\engine\categories;

require_once __SHOP_DIR__ . 'engine/categories/Category.class.php';

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

        $cursor = $this->engine->getDb()->fetchRowMany('SELECT * FROM categories');
        foreach ($cursor as $result) {
            $this->categories[$result['id']] =
                new Category($result['id'], $result['name'], $result['parent'], json_decode($result['parameters']),
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

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }
}