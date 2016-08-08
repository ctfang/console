<?php
namespace Console\System;
/**
 * Created by PhpStorm.
 * User: 007
 * Date: 2016/8/8
 * Time: 13:06
 */
class Migration
{

    static public function create($route_name,$remark,$field_sql){
        $sql = "CREATE TABLE IF NOT EXISTS `{$route_name}` ({$field_sql}) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='{$remark}';";
        echo $sql;
    }

    // 绑定注册
    static public function down($route_name) {

    }
}