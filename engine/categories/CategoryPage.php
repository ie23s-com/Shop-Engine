<?php

namespace ie23s\shop\engine\categories;

use ie23s\shop\system\pages\Page;
use ie23s\shop\system\pages\Theme;
use Simplon\Mysql\MysqlException;
use SmartyException;

class CategoryPage extends Page
{

    /**
     * @throws SmartyException
     * @throws MysqlException
     */
    public function request(array $request): string
    {
        $ce = $this->getSystem()->getEngine()->getCategoriesEngine();
        $cat = $ce->getCategory($request[1]);
        if ($cat == null) {
            $this->getPages()->error(404, "Not found");
        }
        $ce->findParents($cat);
        $ce->findChildren($cat);

        $theme = new Theme();
        $theme->addArray('category_parent_categories', $cat->getParentsArray());
        $theme->addArray('category_children_categories', $cat->getChildrenArray());
        $theme->addObject('category_current', $cat);
        $theme->addArray('category_products',
            $this->getSystem()->getEngine()->getProductEngine()->getAllProducts($cat->getId()));
        $this->getPages()->setTitle($cat->getDisplayName());
        return $theme->getTpl('category');
    }
}