<?php
namespace Console\System;

use Console\config;
/**
 * Created by PhpStorm.
 * User: 007
 * Date: 2016/8/8
 * Time: 14:02
 */
class Db
{
    static public $connect ;

    static public function create( $sql ){
        $con    = self::getConnection();
        $status = $con->query( $sql );
        if( $status ){
            return true;
        }else{
            echo "\n error \n$sql\n";
        }
    }
    static public function query($sql){
        $con    = self::getConnection();
        $status = $con->query( $sql );
        if( $status ){
            return $status;
        }else{
            echo "\n error \n$sql\n";
        }
    }
    static public function getConnection(){
        if ( isset(self::$connect) ){
            return self::$connect;
        }
        $config = config::db();
        $new_config = array(
            'dsn'=>"{$config['type']}:host={$config['hostname']};port={$config['hostport']};dbname={$config['database']}",
            'username'=>$config['username'],
            'password'=>$config['password']
        );
        try{
            self::$connect = new \PDO($new_config['dsn'], $new_config['username'], $new_config['password']);
        }catch (PDOException $e) {
            print "错误: ".$e->getMessage()."<br />"; print "行号: ".$e->getLine()."<br />"; die();
        }

        self::$connect->query("SET NAMES {$config['charset']}");
        return self::$connect;
    }
}