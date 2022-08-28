<?PHP

namespace ie23s\shop\system\database;

use Exception;
use ie23s\shop\system\Component;
use PDO;
use Simplon\Mysql;

/**
 * MySQL PDO system component
 */
class MySQLMod extends Component
{
    private PDO $pdoConnection;
    private Mysql\Mysql $dbConnection;

    /**
     * @return Mysql\Mysql
     */
    public function getConn(): Mysql\Mysql
    {
        return $this->dbConnection;
    }

    //Database info init

    /**
     * MysqlConnection init
     * @throws Exception
     */
    public function init()
    {
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
     */
    public function load()
    {
        $this->dbConnection =
            new Mysql\Mysql($this->pdoConnection);
    }

    public function unload()
    {
        $this->dbConnection->close();
    }
}
