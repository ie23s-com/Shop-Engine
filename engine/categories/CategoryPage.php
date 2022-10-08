<?php

namespace ie23s\shop\engine\utils\breadcrumbs\categories;

use Category;
use ie23s\shop\engine\utils\breadcrumbs\BreadcrumbModel;
use ie23s\shop\engine\utils\breadcrumbs\Breadcrumbs;
use ie23s\shop\system\pages\Page;
use Simplon\Mysql\MysqlException;
use SmartyException;
use TypeError;

class CategoryPage extends Page
{
    private Breadcrumbs $breadcrumbs;
    private CategoriesEngine $categoryEngine;

    /**
     * @throws SmartyException
     * @throws MysqlException
     */
    public function request(array $request): string
    {
        $this->categoryEngine = $this->getSystem()->getEngine()->getCategoriesEngine();
        try {
            $cat = $this->categoryEngine->getCategory($request[1]);
        } catch (TypeError $e) {
        }
        if (@$cat == null) {
            $this->getPages()->error(404, "Not found");
        }
        $this->categoryEngine->findChildren($cat);

        $theme = $this->getPages()->getTheme();

        //breadcrumbs
        $this->createBreadcrumbs($cat);
        $theme->addObject('breadcrumbs', $this->breadcrumbs);

        //end breadcrumbs

        $theme->addObject('category_children_categories', $cat->getChildrenArray());
        $theme->addObject('category_products',
            $this->getSystem()->getEngine()->getProductEngine()->getAllProducts($cat->getId()));
        $this->getPages()->setTitle($cat->getDisplayName());

        return $theme->getTpl('category');
    }

    private function createBreadcrumbs(Category $category)
    {
        $this->breadcrumbs = new Breadcrumbs();
        $this->categoryEngine->findParents($category);
        /**
         * @var Category $cat
         */
        foreach ($category->getParentsArray() as $cat) {
            $this->breadcrumbs->add(new BreadcrumbModel($cat->getDisplayName(), '/category/' . $cat->getId()));
        }
        $this->breadcrumbs->add(new BreadcrumbModel($category->getDisplayName(), 'javascript:void(0);'));

    }
}