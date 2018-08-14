<?php
namespace EHS;

class Router {
    public static $routes = [
        "default"   => ["\EHS\Controllers\Home", "index"],
        "register"  => ["\EHS\Controllers\User", "register"],
        "doregister"    => ["\EHS\Controllers\User", "doRegister"],
        "login"     => ["\EHS\Controllers\User", "login"],
        "dologin"   => ["\EHS\Controllers\User", "doLogin"]
    ];

    public static function route($action) {
        if (!array_key_exists($action, self::$routes)) {
            $action = "default";
        }

        $route = self::$routes[$action];
        $c = new $route[0]();
        
        return call_user_func_array(array($c, $route[1]), []);
    }
}
