<?php
namespace Console\Extend;

use Console\config;
use Console\System;
use Console\System\Build;

/**
 * Created by PhpStorm.
 * User: selden1992
 * Date: 2016/8/7
 * Time: 12:13
 */
class Make
{
    /**
     * 创建控制器
     * @return string
     */
    static public function controller(){
        $param = config::param();
        $arr = System\Directory::explode($param['0']);

        if( empty($arr[0]) || empty($arr[1]) ){
            return "\033[0;41;1m module name is null;Enter module/controller\n";
        }
        if( empty($param[1]) ){
            // 普通控制器
            Build::buildController( $arr['0'],$arr[1] );
        }elseif( $param[1]=='--resource' ){
            // 资源控制器
            Build::buildResource( $arr['0'],$arr[1] );
        }
    }
    static public function model(){
        $param  = config::param();
        $arr    = System\Directory::explode($param['0']);
        if( empty($arr[0]) || empty($arr[1]) ){
            return "\033[0;41;1m module name is null;Enter module/controller\n";
        }

        Build::buildModel( $arr['0'],$arr[1] );
    }
    static public function view(){
        $param = config::param();
        $arr = System\Directory::explode($param['0']);
        if( empty($arr[0]) || empty($arr[1]) || empty($arr[2]) ){
            return "\033[0;41;1m module name is null;Enter module/view_dir/html_name]\n";
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
            if( empty($module) ) return "\033[0;41;1m module name is null\n";
        }
        Build::buildAppDir( $module );
    }
    static public function migration(){
        $param      = config::param();
        $table_name = $param[0];

        $database_dir = config::database().'/migrations/';
        if(!is_dir( $database_dir ))  mkdir($database_dir,0755,true);
        if( empty($table_name) ) return "\033[0;41;1m table_name is null\n";

        $filename = $database_dir.$table_name.'.php';
        if( !is_file($filename ) ){
            $str = file_get_contents( dirname(__FILE__).'/migrate/create_seeder.tpl');
            $str = str_replace("[class_name]", $table_name, $str);
            file_put_contents($filename, $str);
            echo 'create '.$filename;
        }else{
            return "\033[0;41;1m table_name is has";
        }

    }
    static public function seeder(){
        $param      = config::param();
        $table_name = $param[0];
        $new_file   = config::database().'/seeds/'.$table_name.'.php';
        if( empty($table_name) ) return "\033[0;41;1m table_name isnull\n";
        if( is_file( $new_file ) )  return "\033[0;41;1m$table_name is has\n";
        $filename   = config::database().'/migrations/'.$table_name.'.php';
        if( !is_file( $filename ) )  return "\033[0;41;1mnot find this $table_name migrate\n";

        $sql        = "DESC $table_name";
        $rs         = System\Db::query( $sql );
        $str_sql    = '';
        while($row = $rs->fetch()){
            $value = $row['Default'];
            if( empty($row['Default']) ){
                $value = $row['Field'];
            }
            if( !empty($str_sql) ){
                $str_sql = $str_sql.',';
            }
            $str_sql  = $str_sql."'$value'";
        }
        $nest =  'INSERT INTO `'.$table_name.'` VALUES ('.$str_sql.');';

        if( !is_dir(dirname($new_file)) )  mkdir(dirname($new_file),0755,true);
        file_put_contents($new_file, $nest);
        echo "\ncreate $table_name successfully\n";
    }
    static public function input(){
        $param = config::param();
        $arr = System\Directory::explode($param['0']);

        if( empty($arr[0]) || empty($arr[1]) ){
            return "\033[0;41;1m module name is null;Enter module/input\n";
        }
        if( empty($param[1]) ){
            // 普通控制器
            Build::buildInput( $arr['0'],$arr[1] );
        }elseif( $param[1]=='--resource' ){
            // 资源控制器
            Build::buildInputResource( $arr['0'],$arr[1] );
        }
    }
}