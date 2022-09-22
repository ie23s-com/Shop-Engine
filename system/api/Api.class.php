<?php

namespace ie23s\shop\system\api;

require_once __SHOP_DIR__ . "system/api/ApiPage.class.php";

use ie23s\shop\system\Component;

class Api extends Component
{

    /**
     * @inheritDoc
     */
    public function load()
    {
        $apiPage = new ApiPage('api', $this->getSystem()->getPages(), 'api');
        $apiPage->setApi($this);
    }

}