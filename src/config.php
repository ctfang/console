<?php
namespace Console;

/**
 * 获取tp or myself 配置类
 */
class config
{
    static public $app_path ='./Application/';

    static public $config_path ='./Application/Common/Conf/config.php';

    static protected $config ;

    static public function __callStatic($funcname, $arguments){
        if(isset(self::$$funcname)){
            return self::$$funcname;
        }
        self::set();

        return self::$config[$funcname];
    }

    static public function set($name='',$value=''){
        if ( !isset(self::$config) && config::config_path() ){
            if( !is_file(config::config_path()) ){
                mkdir(dirname(config::config_path()), 0755, true);
                file_put_contents(config::config_path(),'<?php retuern [];');
            }
            self::$config = include config::config_path();
        }
        if( isset(self::$$name) && $value!='' ){
            self::$$name  = $value;
        }elseif ($value!=''){
            self::$config[$name] = $value;
        }
    }
}