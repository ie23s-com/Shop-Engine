<?PHP

namespace ie23s\shop\system\database;

use Exception;
use ie23s\shop\system\Component;
use ie23s\shop\system\System;
use Simplon\Mysql;

/**
 * MySQL PDO system component
 */
class MySQLMod extends Component
{
    private $pdoConnection = null;
    private $dbConnection = null;

    //Database info init

    /**
     * MysqlConnection init
     * @throws Exception
     */
    public function init(System $system)
    {
        $this->setSystem($system);
        $pdo = new Mysql\PDOConnector(
            $_ENV['DB_HOST'], // server
            $_ENV['DB_USER'],      // user
            $_ENV['DB_PASS'],      // password
            $_ENV['DB_NAME']   // database
        );
        $this->pdoConnection = $pdo->connect('utf8', []); // charset, ops
        // $pdoConnection->setAttribute($attribute, $value);
    }

    /**
     * Mysql connection
     * @throws Mysql\MysqlException
     */
    public function load()
    {
        /** @noinspection PhpParamsInspection */
        $this->dbConnection =
            new Mysql\Mysql($this->pdoConnection);

        $result = $this->dbConnection->fetchColumn('SHOW TABLES');

        //var_dump($result);
    }

    public function unload()
    {
        $this->dbConnection->close();
    }
}
