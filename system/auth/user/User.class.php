<?php

namespace ie23s\shop\system\auth\user;

class User extends UserModel
{
    public function verifyPassword($password): bool
    {
        return password_verify($this->getSalt() . $_ENV['PEPPER'] . $password, $this->getHash());
    }
}