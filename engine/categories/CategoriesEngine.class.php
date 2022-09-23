<?php

namespace ie23s\shop\engine\categories;

require_once __SHOP_DIR__ . 'engine/categories/Category.class.php';
require_once __SHOP_DIR__ . 'engine/categories/CategoryPage.php';

use Category;
use ie23s\shop\engine\Engine;
use ie23s\shop\system\pages\Pages;
use Simplon\Mysql\MysqlException;
use SmartyException;

class CategoriesEngine
{

    private Engine $engine;

    private array $categories = array();
    private Pages $pages;

    /**
     * @param Engine $engine
     * @throws MysqlException
     */
    public function __construct(Engine $engine)
    {
        $this->engine = $engine;

        $this->loadCategories();

        $this->pages = $engine->getSystem()->getPages();
    }

    public function load()
    {
        new CategoryPage('category', $this->pages, 'category', 'cat');
    }

    /**
     * @throws MysqlException
     */
    public function loadCategories()
    {
        $cursor = $this->engine->getDb()->fetchRowMany('SELECT *,
               (SELECT language_editable.value
                FROM language_editable 
                WHERE language_editable.`type` = \'category-name\' AND language_editable.external_id = categories.id)
                   AS display_name
        FROM categories');
        foreach ($cursor as $result) {
            $this->categories[$result['id']] =
                new Category($result['id'], $result['name'], $result['parent'], json_decode($result['parameters']),
                    $result['display_name']);
        }
        $this->categories[0] = new Category(0, 'main', -1, []);
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

        while ($parent->getParentId() != 0 && $this->getCategory($parent->getParentId()) !== null) {
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

    /**
     * @throws MysqlException
     */
    public function createCategory(Category $category)
    {
        $id = $this->engine->getDb()->insert('categories',
            ['name' => $category->getName(), 'parent' => $category->getParentId(), 'parameters' => '[]']);
        $names = [['lang_id' => 1, 'value' => $category->getDisplayName()]];
        $this->engine->getSystem()->getLang()->addEditableRow('category-name', $id, $names);
        $category->setId($id);
        $this->categories[$id] = $category;
    }

    /**
     * @throws MysqlException
     * @throws SmartyException
     */
    public function removeCategory(int $id)
    {

        $category = $this->getCategory($id);
        $this->findChildren($category);
        $categoriesToDelete = [$id];
        /**
         * var $child Category
         */
        foreach ($category->getChildrenArray() as $child) {
            $categoriesToDelete[] = $child->getId();
        }
        $count = $this->engine->getDb()->fetchColumn('SELECT COUNT(*) FROM products WHERE category IN (:ids)',
            ['ids' => $categoriesToDelete]);
        if ($count != 0) {
            $this->pages->error('401', 'You cannot remove category with products');
        }

        $this->engine->getDb()->fetchColumn('DELETE FROM categories WHERE id IN (:ids)',
            ['ids' => $categoriesToDelete]);
        foreach ($categoriesToDelete as $id) {
            $this->engine->getSystem()->getLang()->deleteEditableRow("category-name", $id);
            unset($this->categories[$id]);
        }
    }

    /**
     * @throws MysqlException
     */
    public function updateCategory(?Category $category)
    {
        $this->engine->getDb()->update('categories', ['id' => $category->getId()], [
            'name' => $category->getName(), 'parent' => $category->getParentId(),
            'parameters' => json_encode($category->getParams())
        ]);

        $names = [['lang_id' => 1, 'value' => $category->getDisplayName()]];
        $this->engine->getSystem()->getLang()->editEditableRow("category-name", $category->getId(), $names);
    }
}