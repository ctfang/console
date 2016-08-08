<?php
namespace Console\Extend;

use Console\config;
/**
 * Created by PhpStorm.
 * User: 007
 * Date: 2016/8/8
 * Time: 10:00
 */
class Db
{
    static public function seed(){
        $param      = config::param();
        $table_name = $param[0];
        $dir = config::database().'/seeds/';
        if( strpos($table_name,'--class=')!==false ){
            $table_name   = explode('=',$table_name);
            $table_name   = end($table_name);
            if( is_file($dir.$table_name .'.php') ){
                $sql          = file_get_contents($dir.$table_name .'.php');
                self::insert($sql);
                echo "\nseed table $table_name successfully";
            }
        }else{
            $file=scandir($dir);
            unset($file[0]);unset($file[1]);
            foreach ($file as $name) {
                $sql = file_get_contents($dir.$name);
                self::insert($sql);
                echo "\nseed $name successfully";
            }
        }
    }
    static public function insert( $sql ){
        $sql = str_replace("\r", "\n", $sql);
        $sql = explode(";\n", $sql);
        foreach ($sql as $value) {
            $value = trim($value);
            if(empty($value)) continue;
            \Console\System\Db::query( $value );
        }
    }
}