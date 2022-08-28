<?PHP

namespace ie23s\shop\system\config;

use Dotenv\Dotenv;
use ie23s\shop\system\Component;

/**
 * Configuration system component
 */
class Config implements Component
{
    private $dotenv = null;

    //Loading configuration file .config
    public function init()
    {
        $this->dotenv = Dotenv::createImmutable(__SHOP_DIR__,
            '.config.env');
        $this->dotenv->load();
    }

    //Checking config file
    public function load()
    {
        $this->dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);
    }

    public function unload()
    {

    }
}
