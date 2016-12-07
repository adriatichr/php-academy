<?php

namespace Adriatic\PHPAkademija\OOPIntro\StaticMethodsAndVariables;

class Foo
{
    private static $hello = 'Hello world';

    public static function bar()
    {
        return self::baz();
    }

    private static function baz()
    {
        return self::$hello;
    }
}
