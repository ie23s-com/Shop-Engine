<?PHP

namespace ie23s\shop\system;

//Component interface loader
use ie23s\shop\system\pages\Pages;

require_once __SHOP_DIR__ . "system/component.php";
//Config component loader
require_once __SHOP_DIR__ . "system/config/Config.class.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/database/MySQLMod.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/pages/Pages.class.php";


/**
 * This class loads all system components
 */
class System
{
    private $components = array();

    //Initialization components
    public function init()
    {

        //Init Config
        $config = new config\Config();
        $config->init($this);
        $config->load();
        $config = null;

        //Init DB
        $this->components["database"] = new database\MySQLMod();
        $this->components["database"]->init($this);//TODO Exception

        //Init Theme
        $this->components["pages"] = new Pages();
        $this->components["pages"]->init($this);
    }

    public function load()
    {
        //Load DB
        $this->components["database"]->load();

        //Load Theme
        $this->components["pages"]->load();
    }

    public function unload()
    {
        //Unload Theme
        $this->components["pages"]->unload();
    }

    /**
     * @return Component
     */
    public function getComponent($component): Component
    {
        return $this->components[$component];
    }
}
