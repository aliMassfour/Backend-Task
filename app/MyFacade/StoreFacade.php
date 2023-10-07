<?php


namespace App\MyFacade;

use BadMethodCallException;

class StoreFacade
{
    protected static $methods = ['StoreImage'];
    public static function ResolveFacade($name)
    {
        return app()[$name];
    }
    public static function __callStatic($method, $arguments)
    {
        if (!in_array($method, static::$methods)) {
            throw new BadMethodCallException("undefined method " . $method);
        }
        return (static::ResolveFacade('StoreImage'))->$method(...$arguments);
    }
}
