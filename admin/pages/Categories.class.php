<?php

namespace ie23s\shop\admin\pages;

use Category;
use ie23s\shop\engine\categories\CategoriesEngine;
use ie23s\shop\system\pages\Theme;

class Categories extends AdminPage
{
    private CategoriesEngine $categoriesEngine;
    /**
     * @return string
     */
    function getPage(): string
    {
        $this->categoriesEngine = $this->getEngine()->getCategoriesEngine();

        $theme = new Theme();

        $theme->addArray('admin_edit_cats', $this->editableCategories());
        $theme->addArray('admin_cats_list', $this->categoriesEngine->getCategories());

        return $theme->getTpl('admin/categories');
    }

    private function editableCategories() : array {
        $r = array();
        /** @var Category $category */
        foreach ($this->categoriesEngine->getCategories() as $category) {
            $r[] = array(
                'id' => $category->getId(),
                'name' => $category->getName(),
                'display_name' => $category->getDisplayName(),
                'parent_id' => $category->getParentId()

            );
        }
        return $r;
    }

}