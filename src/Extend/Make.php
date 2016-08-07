<?php
namespace Console\Extend;

use Console\System;

use Console\config;
/**
 * Created by PhpStorm.
 * User: selden1992
 * Date: 2016/8/7
 * Time: 12:13
 */
class Make
{
    static public function controller(){
        $param = config::param();
        $arr = explode("/",$param[0] );
        if( empty($arr[0]) || empty($arr[1]) ){
            return "\033[0;41;1m module name is null;Enter module/controller";
        }
        $buil = new System\Build;
        $buil::buildController( $arr['0'],$arr[1] );
    }
    static public function model(){
        $param = config::param();
        $arr = explode("/",$param[0] );
        if( empty($arr[0]) || empty($arr[1]) ){
            return "\033[0;41;1m module name is null;Enter module/controller";
        }
        $buil = new System\Build;
        $buil::buildModel( $arr['0'],$arr[1] );
    }
    static public function view(){
        $param = config::param();
        $arr = explode("/",$param[0] );
        if( empty($arr[0]) || empty($arr[1]) || empty($arr[2]) ){
            return "\033[0;41;1m module name is null;Enter module/view_dir/html_name";
        }
        $file_path = config::app_path().'/'.$arr[0].'/View/'.$arr[1].'/'.$arr[2];
        if(!is_dir(dirname($file_path)))  mkdir(dirname($file_path),0755,true);
        file_put_contents( $file_path,'创建成功');
    }
    static public function module(){
        $param  = config::param();
        $module = $param[0];
        if( empty($module) ){
            fwrite(STDOUT, "Enter your module name: ");
            $module = trim(fgets(STDIN));
            if( empty($module) ) return "\033[0;41;1m module name is null";
        }
        $buil = new System\Build;
        $buil::buildAppDir( $module );
    }
    static public function migration(){
        $param      = config::param();
        $table_name = $param[0];

        $database_dir = config::database().'/migrations/';
        if(!is_dir( $database_dir ))  mkdir($database_dir,0755,true);
        if( empty($table_name) ) return "\033[0;41;1m table_name is null";

        $filename = $database_dir.$table_name.'.php';
        if( !is_file($filename ) ){
            $str = file_get_contents( dirname(__FILE__).'/migrate/create_table.php');
            $str = str_replace("[class_name]", $table_name, $str);
            file_put_contents($filename, $str);
            echo 'create '.$filename;
        }else{
            return "\033[0;41;1m table_name is has";
        }

    }
}