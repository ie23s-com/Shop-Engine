<?php

namespace ie23s\shop\engine\utils\breadcrumbs\product;

use Category;
use ie23s\shop\engine\utils\breadcrumbs\BreadcrumbModel;
use ie23s\shop\engine\utils\breadcrumbs\Breadcrumbs;
use ie23s\shop\engine\utils\breadcrumbs\categories\CategoriesEngine;
use ie23s\shop\engine\utils\breadcrumbs\Engine;
use ie23s\shop\system\pages\Page;
use Simplon\Mysql\MysqlException;
use SmartyException;

class ProductPage extends Page
{
    private ProductEngine $productEngine;
    private CategoriesEngine $categoryEngine;
    private Breadcrumbs $breadcrumbs;

    /**
     * @param array $request
     * @return string
     * @throws MysqlException
     * @throws SmartyException
     */
    public function request(array $request): string
    {
        $product = $this->productEngine->getProductById($request[1]);

        if ($product == null)
            $this->getPages()->error(404, "This product not found");
        $theme = $this->getPages()->getTheme();
        $theme->addObject('product', $product);
        $theme->addBlock('product_name', $this->getLang()->getEditableRow("product-name", $product->getId()));

        //Breadcrumb
        $category = $this->categoryEngine->getCategory($product->getCategory());
        $this->createBreadcrumbs($category, $product);
        $theme->addObject('breadcrumbs', $this->breadcrumbs);
        //end Breadcrumb

        $theme->addObject('product_photos', $product->getPhotos());
        $this->getPages()->setTitle($this->getLang()->getEditableRow("product-name", $product->getId()));
        return $theme->getTpl('product');
    }

    private function createBreadcrumbs(Category $category, Product $product)
    {
        $this->breadcrumbs = new Breadcrumbs();
        $this->categoryEngine->findParents($category);
        /**
         * @var Category $cat
         */
        foreach ($category->getParentsArray() as $cat) {
            $this->breadcrumbs->add(new BreadcrumbModel($cat->getDisplayName(), '/category/' . $cat->getId()));
        }
        $this->breadcrumbs->add(new BreadcrumbModel($category->getDisplayName(), '/category/' . $category->getId()));

        $this->breadcrumbs->add(new BreadcrumbModel($product->getDisplayName(), 'javascript:void(0)'));
    }

    public function load(Engine $param)
    {
        $this->productEngine = $param->getProductEngine();
        $this->categoryEngine = $param->getCategoriesEngine();
    }
}