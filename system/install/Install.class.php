<?php

namespace ie23s\shop\system\install;

use ie23s\shop\system\Component;

class Install extends Component
{
    private ?array $path;

    /**
     * @inheritDoc
     */
    public function load()
    {
        $this->path = $this->getSystem()->getPages()->getPath();

        if ($this->path[0] != 'install') {
            header("Location: /install/");
        } else {
            echo file_get_contents(__SHOP_DIR__ . 'system/install/index.html');
        }
    }
}