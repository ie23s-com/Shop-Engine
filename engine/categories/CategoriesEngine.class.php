<?php

namespace ie23s\shop\engine\categories;

require_once __SHOP_DIR__ . 'engine/categories/Category.class.php';
require_once __SHOP_DIR__ . 'engine/categories/CategoryPage.php';

use Category;
use ie23s\shop\engine\Engine;
use Simplon\Mysql\MysqlException;

class CategoriesEngine
{

    private Engine $engine;

    private array $categories = array();
    private $pages;

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
        $this->pages = $engine->getSystem()->getPages();
    }

    public function load()
    {
        new CategoryPage('category', $this->pages);
    }

    /**
     * @param int $id
     * @return ?Category
     */
    public function getCategory(int $id): ?Category
    {
        return $this->categories[$id] ?? null;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }


    public function findParents(Category $category)
    {
        $parent = $category;

        while ($this->getCategory($parent->getParentId()) !== null) {
            $parent = $this->getCategory($parent->getParentId());
            $category->addParent($this->getCategory($parent->getId()));
        }
    }

    public function findChildren(Category $category)
    {

        foreach ($this->categories as $mChild) {
            if ($category->getId() == $mChild->getParentId()) {
                $category->addChild($mChild);
            }
        }
    }
}