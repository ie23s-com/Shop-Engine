<?php

namespace ie23s\shop\system\auth\user;

use Exception;
use ie23s\shop\system\auth\Auth;
use ie23s\shop\system\database\MySQLMod;
use ie23s\shop\system\System;
use Simplon\Mysql\Mysql;
use Simplon\Mysql\MysqlException;

class Session
{
    private Mysql $db;

    public function __construct(System $system)
    {
        session_start();
        /** @var MySQLMod $db */
        $db = $system->getComponent('database');
        $this->db = $db->getConn();
    }

    /**
     * @throws Exception
     */
    public function generateSession($user_id, $expire = 3600)
    {
        // This token is used by forms to prevent cross site forgery attempts
        if (!isset($_SESSION['nonce']))
            $_SESSION['nonce'] = md5(microtime(true));

        if (!isset($_SESSION['userAgent']))
            $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];

        $_SESSION['server_id'] = bin2hex(random_bytes(32));

        // Set current session to expire in 1 minute
        if ($expire != -1) {
            $_SESSION['OBSOLETE'] = true;
            $_SESSION['EXPIRES'] = time() + $expire;
        } else {

            $_SESSION['OBSOLETE'] = false;
        }

        session_regenerate_id();

        // Grab current session ID and close both sessions to allow other scripts to use them
        $newSession = session_id();

        session_write_close();

        // Set session ID to the new one, and start it back up again
        session_id($newSession);
        session_start();

        $this->writeSQLData($newSession, $_SESSION['server_id'], $user_id, $expire);
    }

    /**
     * @throws MysqlException
     */
    public function checkSession(): int
    {
        $this->updateExpired();
        try {
            if ($_SESSION['OBSOLETE'] && ($_SESSION['EXPIRES'] < time()))
                throw new Exception('Attempt to use expired session.');

            if (isset($_SESSION['server_id']))
                throw new Exception('No session started.');

            if ($_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'])
                throw new Exception('Useragent mixmatch (possible session hijacking attempt).');

            $user_id = $this->db->fetchColumn('SELECT `user_id` FROM `sessions`
                                    WHERE session_id = :SESSION_ID AND
                                          expired = false AND
                                          server_id = :SERVER_ID',
                ['SESSION_ID' => session_id(), 'SERVER_ID' => $_SESSION['server_id']]);

            if ($user_id == null)
                throw new Exception('User not found');
            if ($_SESSION['OBSOLETE'])
                $this->db->update('sessions', ['session_id' => session_id()],
                    ['expire_time' => Auth::timeToDate(time() + 3600)]);

            return $user_id;
        } catch (Exception $e) {
            return -1;
        }
    }

    /**
     * @throws MysqlException
     */
    private function writeSQLData($session_id, $server_id, $user_id, $expire)
    {
        $time = time();
        if ($expire != -1) {
            $expire = $time + $expire;
        } else {
            $expire = $time + 31536000;
        }
        $this->db->insert('sessions', ['session_id' => $session_id, 'server_id' => $server_id,
            'user_id' => $user_id, 'login_time' => Auth::timeToDate($time),
            'expire_time' => Auth::timeToDate($expire)]);
    }

    /**
     * @throws MysqlException
     */
    private function updateExpired()
    {
        $time = Auth::timeToDate(time());
        $this->db->executeSql("UPDATE sessions SET expired = true
                WHERE expired = false AND expire_time <= {$time}");
    }
}