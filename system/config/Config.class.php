<?PHP

namespace ie23s\shop\system\config;

/***
Configuration system component
***/
class Config implements \ie23s\shop\system\Component {
        private $dotenv = null;
        //Loading configutation file .config
        public function init() {
            $this->dotenv = \Dotenv\Dotenv::createImmutable(__SHOP_DIR__,
                '.config.env');
            $this->dotenv->load();
        }
        //Checking config file
        public function load() {
            $this->dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);
        }
        public function unload() {

        }
}
