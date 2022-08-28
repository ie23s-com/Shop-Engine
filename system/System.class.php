<?PHP

namespace ie23s\shop\system;

//Component interface loader
use Exception;
use ie23s\shop\system\lang\Lang;
use ie23s\shop\system\pages\Pages;

require_once __SHOP_DIR__ . "system/component.php";
//Config component loader
require_once __SHOP_DIR__ . "system/config/Config.class.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/lang/Lang.class.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/database/MySQLMod.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/pages/Pages.class.php";


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
        $config->init();
        $config->load();
        $config = null;

        //Init DB
        $this->components["database"] = new database\MySQLMod($this);
        $this->components["database"]->init();//TODO Exception

        //Init Lang
        $this->components["lang"] = new Lang($this);
        $this->components["lang"]->init();

        //Init Theme
        $this->components["pages"] = new Pages($this);
        $this->components["pages"]->init();
    }

    public function load()
    {
        //Load DB
        $this->components["database"]->load();
        //Load Lang
        $this->components["lang"]->load();

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

    public function getLang(): Lang
    {
        /** @var $r Lang */
        $r = $this->getComponent('lang');
        return $r;
    }
}
