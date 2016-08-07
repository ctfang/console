<?php
class Route{
    public $binds;

    private static $_instance;
    // 绑定注册
    public function register($route_name,$model) {
        $route = Route::getInstance();

        $route->binds[$route_name] = $model;
    }
    // 创建
    public function make($abstract, $parameters = []) {
        $route = Route::getInstance();
        if( !isset($route->binds[$abstract]) ){
            die("\033[0;33;1mnot find this route");
        }
        $parameters = (array)$parameters;
        return call_user_func_array($route->binds[$abstract], $parameters);
    }
    public static function getInstance(){
        if( !(self::$_instance instanceof self) ){
            self::$_instance = new self;
        }
        return self::$_instance;
    }
}