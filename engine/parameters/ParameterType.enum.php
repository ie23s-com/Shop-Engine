<?php

namespace ie23s\shop\engine\parameters;

use MyCLabs\Enum\Enum;

class ParameterType extends Enum
{
    const NUMBER = 0;
    const STRING = 1;
    const SELECT = 2;
}