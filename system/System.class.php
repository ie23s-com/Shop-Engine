<?PHP
namespace ie23s\shop\system;

//Component interface loader
require_once __SHOP_DIR__ . "system/component.php";
//Config component loader
require_once __SHOP_DIR__ . "system/config/Config.class.php";
//MySQL component loader
require_once __SHOP_DIR__ . "system/database/MySQL.class.php";



/**
This class loads all system components
*/
class System
{
    private $components = array();

    //Initialization components
    public function init()
    {

        //Init Config
        $config = new config\Config();
        $config->init();
        $config->load();
        $config = null;

        //Init DB
        $this->components["database"] = new database\MySQLC();
        $this->components["database"]->init();//TODO Exception
    }
    public function load() {
        //Load DB
        $this->components["database"]->load();
    }
}
