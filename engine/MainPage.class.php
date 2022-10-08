<?php

namespace ie23s\shop\engine\utils\breadcrumbs;

use ie23s\shop\system\pages\Page;
use SmartyException;

class MainPage extends Page
{

    /**
     * @throws SmartyException
     */
    public function request(array $request): string
    {
        $engine = $this->getSystem()->getEngine();
        $mainCategory = $engine->getCategoriesEngine()->getCategory(0);
        $engine->getCategoriesEngine()->findChildren($mainCategory);
        $theme = $this->getPages()->getTheme();
        $theme->addObject('categories_list', $mainCategory->getChildrenArray());


        return $theme->getTpl('index');
    }
}