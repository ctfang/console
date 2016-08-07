<?php
namespace Console;

/**
 * 获取tp or myself 配置类
 */
class config
{
    static public $app_path ='./Application/';

    static protected $config ;

    static public function __callStatic($funcname, $arguments){
        if(isset(self::$$funcname)){
            return self::$$funcname;
        }
        self::set();

        return self::$config[$funcname];
    }

    static public function set($name='',$value=''){
        if ( !isset(self::$config) && config::app_path() ){
            self::$config = include config::app_path().'Common/Conf/config.php';
        }
        if( isset(self::$$name) && $value!='' ){
            self::$$name  = $value;
        }elseif ($value!=''){
            self::$config[$name] = $value;
        }
    }
}