<?PHP

namespace ie23s\shop\system;

//Component interface loader
use Exception;
use ie23s\shop\admin\Admin;
use ie23s\shop\engine\Engine;
use ie23s\shop\system\api\Api;
use ie23s\shop\system\lang\Lang;
use ie23s\shop\system\pages\Pages;
require_once __SHOP_DIR__ . "system/Codes.php";

require_once __SHOP_DIR__ . "system/component.php";
//Config component loader
require_once __SHOP_DIR__ . "system/config/Config.class.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/lang/Lang.class.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/database/MySQLMod.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/pages/Pages.class.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/api/Api.class.php";
//MySQL component loader
require_once __SHOP_DIR__ . "engine/Engine.class.php";
//MySQL component loader
require_once __SHOP_DIR__ . "admin/Admin.class.php";


/**
 * This class loads all system components
 */
class System
{
    private array $components = array();

    //Initialization components

    /**
     * @throws Exception
     */
    public function init()
    {

        //Init Config
        $config = new config\Config($this);
        $config->load();
        $config = null;
        //Init Theme
        $this->components["pages"] = new Pages($this);
        //Init DB
        $this->components["database"] = new database\MySQLMod($this);

        //Init Lang
        $this->components["lang"] = new Lang($this);

        //Init API
        $this->components["api"] = new Api($this);

        //Init Shop engine
        $this->components["sEngine"] = new Engine($this);
        //Init Shop engine
        $this->components["admin"] = new Admin($this);
    }

    public function load()
    {
        //Load DB
        $this->components["database"]->load();
        //Load Lang
        $this->components["lang"]->load();
        //Load Theme
        //LAST!
        $this->components["pages"]->load();
        $this->components["api"]->load();
        //Init Shop engine
        $this->components["sEngine"]->load();

    }

    public function unload()
    {
        //Unload Theme
        $this->components["pages"]->unload();
    }

    /**
     * @param $component
     * @return Component
     */
    public function getComponent($component): Component
    {
        return $this->components[$component];
    }

    public function getLang(): Lang
    {
        /** @var $r Lang */
        $r = $this->getComponent('lang');
        return $r;
    }

    public function getPages(): Pages
    {
        /** @var $r Pages */
        $r = $this->getComponent('pages');
        return $r;
    }

    public function getEngine(): Engine
    {
        /** @var $r Engine */
        $r = $this->getComponent('sEngine');
        return $r;
    }

    public function getApi(): Api
    {
        /** @var $r Api */
        $r = $this->getComponent('api');
        return $r;
    }
}
