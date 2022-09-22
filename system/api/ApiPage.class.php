<?php

namespace ie23s\shop\system\api;

use ie23s\shop\system\pages\Page;

class ApiPage extends Page
{
    private Api $api;

    /**
     * @param array $request
     * @return string
     */
    public function request(array $request): string
    {
        define('offTimer', 'off');
        return 'lol';
    }

    /**
     * @param Api $api
     */
    public function setApi(Api $api): void
    {
        $this->api = $api;
    }

    public function needTheme(): bool
    {
        return false;
    }
}