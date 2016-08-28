<?php
namespace Console;

/**
 * 获取tp or myself 配置类
 */
class config
{

    static protected $config ;

    static public function __callStatic($funcname, $arguments){
        return self::$config[$funcname];
    }

    static public function db(){
        $filePath = self::db_path();
        if( !file_exists($filePath) ){
            if( !is_dir(dirname($filePath)) ){
                mkdir(dirname($filePath), 0755, true);
            }
            $elatePath = __DIR__.'/System/Default/db.tpl';
            file_put_contents($filePath,file_get_contents($elatePath));
        }
        /** @noinspection PhpIncludeInspection */
        return  require_once $filePath;
    }

    static public function set($name='',$value=''){
        self::$config[$name] = $value;
    }

    static public function get($name){
        return self::$config[$name];
    }

    static public function all(){
        return self::$config;
    }

    /**
     * @param $filePath
     */
    static public function setAll($filePath){
        if( !file_exists($filePath) ){
            if( !is_dir(dirname($filePath)) ){
                mkdir(dirname($filePath), 0755, true);
            }
            $elatePath  = __DIR__.'/System/Default/console.tpl';
            $string     = file_get_contents($elatePath);
            $path       = __DIR__.'/System/Default';
            $path       = './vendor/'.end(explode('vendor'.DIRECTORY_SEPARATOR,$path));
            $string     = str_replace('[System/Default]',$path,$string);
            file_put_contents($filePath,$string);
        }
        /** @noinspection PhpIncludeInspection */
        self::$config = require $filePath;
    }
}