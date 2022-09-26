<?php

namespace ie23s\shop\system\auth;

require_once __SHOP_DIR__ . '/system/auth/User.class.php';

use Exception;
use ie23s\shop\system\Component;
use Simplon\Mysql\Mysql;

class Auth extends Component
{
    private Mysql $db;

    public function __construct($system)
    {
        parent::__construct($system);
        $this->db = $this->getSystem()->getComponent('database')->getConn();

    }

    /**
     * @inheritDoc
     */
    public function load()
    {
        // TODO: Implement load() method.
    }

    /**
     * @throws Exception
     */
    public static function hashPassword($password): array
    {
        $salt = base64_encode(random_bytes(12));

        $hash = password_hash($salt . $_ENV['PEPPER'] . $password, PASSWORD_BCRYPT);
        return ['salt' => $salt, 'hash' => $hash];
    }

}