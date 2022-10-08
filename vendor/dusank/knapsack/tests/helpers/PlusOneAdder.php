<?php

namespace DusanKasan\Knapsack\Tests\Helpers;

class PlusOneAdder
{
    public static function staticMethod($v)
    {
        return $v + 1;
    }

    public function dynamicMethod($v)
    {
        return $v + 1;
    }
}
