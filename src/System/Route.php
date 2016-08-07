<?php
namespace Console\System;


class Route
{
    static public $binds;

    public function __construct(){
        require_once dirname(__DIR__).'\route.php';
    }

    // 绑定注册
    static public function register($route_name,$model) {
        self::$binds[$route_name] = $model;
    }

    // 创建
    static public function make($abstract, $parameters = []) {
        if( !isset(self::$binds[$abstract]) ){
            die("\033[0;33;1mnot find this route");
        }
        $parameters = (array)$parameters;
        return call_user_func_array(self::$binds[$abstract], $parameters);
    }
}