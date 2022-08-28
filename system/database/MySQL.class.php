<?PHP

namespace ie23s\shop\system\database;

use \Simplon\Mysql;

/***
MySQL PDO system component
***/
class MySQLC implements \ie23s\shop\system\Component {
        private $pdoConnection = null;
        private $dbConnection = null;

        //Database info init
        public function init() {
            $pdo = new Mysql\PDOConnector(
            	$_ENV['DB_HOST'], // server
            	$_ENV['DB_USER'],      // user
            	$_ENV['DB_PASS'],      // password
            	$_ENV['DB_NAME']   // database
            );
            $this->pdoConnection = $pdo->connect('utf8', []); // charset, ops
            // $pdoConnection->setAttribute($attribute, $value);
        }
        public function load() {
            $this->dbConnection =
                new Mysql\Mysql($this->pdoConnection);

            $result = $this->dbConnection->fetchColumn('SHOW TABLES');

            var_dump($result);
        }
        public function unload() {
            $pdoConnection->close();
        }
}
