<?php
/**
* 获取tp的配置
*/
class Thinkphp
{
    private static $_db;
    public static function getInstanceDb(){
        if( !self::$_db ){
            self::$_db = new Db();
        }
        return self::$_db;
    }
    public function get_config(){
        return require_once __TP_APP__.'Common/Conf/config.php';
    }
    public function get_db(){
        return Thinkphp::getInstanceDb();
    }
}
class Db
{
    public $db ;
    function __construct(){
        $config = require_once __TP_APP__.'Common/Conf/config.php';
        $con = mysql_connect($config['DB_HOST'],$config['DB_USER'],$config['DB_PWD']);
        if (!$con){
            die('Could not connect: ' . mysql_error());
        }
        mysql_query('SET NAMES utf8');
        mysql_select_db($config['DB_NAME'], $con);
        $this->db = $con;

    }
    public function query( $sql ){
        $con = $this->db;
        return mysql_query($sql,$con);
    }
}
