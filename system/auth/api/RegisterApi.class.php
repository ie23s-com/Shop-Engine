<?php

namespace ie23s\shop\system\auth\api;

use Exception;
use ie23s\shop\admin\api\ApiAbstract;
use ie23s\shop\system\auth\Auth;
use ie23s\shop\system\auth\user\UserModel;

class RegisterApi extends ApiAbstract
{

    public function get(): string
    {
        return $this->withCode(401);
    }

    /**
     * @throws Exception
     */
    public function post(): string
    {
        /** @var Auth $auth */
        $auth = $this->getSystem()->getComponent('auth');
        $hash = Auth::hashPassword($this->getRequest('password'));
        $user = new UserModel(0, $this->getRequest('email'), $this->getRequest('first_name'),
            $this->getRequest('last_name'), $hash['salt'], $hash['hash'], 1);
        $auth->createUser($user);
        return $this->withCode(200);
    }

    public function put(): string
    {
        return $this->withCode(401);
    }

    public function delete(): string
    {
        return $this->withCode(401);
    }
}