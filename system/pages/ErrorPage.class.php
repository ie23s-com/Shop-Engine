<?php

namespace ie23s\shop\system\pages;

use Simplon\Mysql\MysqlException;
use SmartyException;

class ErrorPage extends Page
{
    private int $error;

    /**
     * @throws SmartyException
     */
    public function request(array $request): string
    {
        $this->setError($request[1]);
        $theme = new Theme();
        $theme->addText('error_text', $this->getError());
        $this->getPages()->setTitle("Error");
        return $theme->getTpl('error');
    }

    /**
     * @return int
     */
    public function getError(): int
    {
        return $this->error;
    }

    /**
     * @param int $error
     */
    public function setError(int $error): void
    {
        $this->error = $error;
    }

}