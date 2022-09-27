<?php

namespace ie23s\shop\system\auth;

require_once __SHOP_DIR__ . '/system/auth/user/UserModel.class.php';
require_once __SHOP_DIR__ . '/system/auth/user/Session.class.php';
require_once __SHOP_DIR__ . '/system/auth/pages/RegisterPage.php';
require_once __SHOP_DIR__ . '/system/auth/api/RegisterApi.class.php';

use Exception;
use ie23s\shop\system\auth\api\RegisterApi;
use ie23s\shop\system\auth\pages\RegisterPage;
use ie23s\shop\system\auth\user\Session;
use ie23s\shop\system\auth\user\UserModel;
use ie23s\shop\system\Component;
use Simplon\Mysql\Mysql;
use Simplon\Mysql\MysqlException;

class Auth extends Component
{
    private Mysql $db;
    private Session $session;

    public function __construct($system)
    {
        parent::__construct($system);

    }

    /**
     * @inheritDoc
     */
    public function load()
    {
        $this->db = $this->getSystem()->getComponent('database')->getConn();
        $this->session = new Session($this->getSystem());
    }

    public function loadPages()
    {
        new RegisterPage('register', $this->getSystem()->getPages(), 'register');

        $this->system->getApi()->addPath('register', new RegisterApi($this->system));


    }


    /**
     * This function creates new user and writes all data to database
     *
     * @param UserModel $user
     * @return void
     * @throws MysqlException
     * @throws Exception
     */
    public function createUser(UserModel $user)
    {
        $id = $this->db->insert('users', ['email' => $user->getEmail(), 'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(), 'salt' => $user->getSalt(), 'hash' => $user->getHash(),
            'group' => $user->getGroup()]);
        $this->session->generateSession($id, -1);
    }

    /**
     * This method make hash of written password
     *
     * @param string $password - user created password
     * @throws Exception
     */
    public static function hashPassword(string $password): array
    {
        $salt = base64_encode(random_bytes(12));

        $hash = password_hash($salt . $_ENV['PEPPER'] . $password, PASSWORD_BCRYPT);
        return ['salt' => $salt, 'hash' => $hash];
    }


    public static function timeToDate($unixTimestamp)
    {
        return date("Y-m-d H:i:s", $unixTimestamp);
    }
}