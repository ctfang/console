<?php
namespace Console\System;
/**
 * Created by PhpStorm.
 * User: 007
 * Date: 2016/7/6
 * Time: 18:46
 */
class MigrationModel
{
    public function create_table( $sql ){
        $sql = str_replace("\r", "\n", $sql);
        $sql = explode(";\n", $sql);
        $tp = new Thinkphp;
        $db = $tp->get_db();
        foreach ($sql as $value) {
            $value = trim($value);
            if(empty($value)) continue;
            $db->query( $value );
        }

    }
    public function delete_table( $table_name ){
        $tp = new Thinkphp;
        $db = $tp->get_db();
        $sql = "DROP TABLE IF EXISTS `".$table_name."`";
        $db->query( $sql );
    }
    public function insert( $sql ){
        $sql = str_replace("\r", "\n", $sql);
        $sql = explode(";\n", $sql);
        $tp = new Thinkphp;
        $db = $tp->get_db();
        foreach ($sql as $value) {
            $value = trim($value);
            if(empty($value)) continue;
            $db->query( $value );
        }
    }
}