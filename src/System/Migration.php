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
    /**
     * 创建
     * @param $sql
     * @return bool
     */
    static public function create($sql){
        return Db::create($sql);
    }

    /**
     * 删除
     * @param $table_name
     * @return bool
     */
    static public function drop($table_name) {
        $sql = "DROP TABLE IF EXISTS `".$table_name."`";
        return Db::query($sql);
    }
}