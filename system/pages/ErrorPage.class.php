<?php

namespace ie23s\shop\system\pages;

use SmartyException;

class ErrorPage extends Page
{
    private int $error;
    private string $text;

    /**
     * @throws SmartyException
     */
    public function request(array $request): string
    {
        $theme = new Theme();
        $theme->addText('error_num', $this->error);
        $theme->addText('error_text', $this->text);
        $this->getPages()->setTitle($this->error);
        return $theme->getTpl('error');
    }

    /**
     * @param int $error
     * @throws SmartyException
     */
    public function setError(int $error, string $text = ''): void
    {
        $this->error = $error;
        $this->text = $text;
        http_response_code($error);
        $this->getPages()->unload();
        die();
    }

}