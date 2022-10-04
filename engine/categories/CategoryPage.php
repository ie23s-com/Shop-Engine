<?php

namespace ie23s\shop\engine\categories;

use ie23s\shop\system\pages\Page;
use ie23s\shop\system\pages\Theme;
use Simplon\Mysql\MysqlException;
use SmartyException;
use TypeError;

class CategoryPage extends Page
{

    /**
     * @throws SmartyException
     * @throws MysqlException
     */
    public function request(array $request): string
    {
        $ce = $this->getSystem()->getEngine()->getCategoriesEngine();
        try {
            $cat = $ce->getCategory($request[1]);
        } catch (TypeError $e) {
        }
        if (@$cat == null) {
            $this->getPages()->error(404, "Not found");
        }
        $ce->findParents($cat);
        $ce->findChildren($cat);

        $theme = $this->getPages()->getTheme();
        $theme->addObject('category_parent_categories', $cat->getParentsArray());
        $theme->addObject('category_children_categories', $cat->getChildrenArray());
        $theme->addObject('category_current', $cat);
        $theme->addObject('category_products',
            $this->getSystem()->getEngine()->getProductEngine()->getAllProducts($cat->getId()));
        $this->getPages()->setTitle($cat->getDisplayName());

        return $theme->getTpl('category');
    }
}