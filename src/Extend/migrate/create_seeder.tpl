<?php
namespace Console\Database\Migrations;

use Console\System\Migration;

class [class_name] extends Migration
{
    /**
     * 创建数据表
     */
    public function up()
    {
        $sql = <<<sql
CREATE TABLE
IF NOT EXISTS `[class_name]` (
	`id` INT (11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id',
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '数据创建时间',
	`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
	PRIMARY KEY (`id`)
) ENGINE = INNODB DEFAULT CHARSET = utf8 COMMENT = '新增数据表';
sql;
        self::create( $sql );
    }

    /**
     * 删除数据表
     */
    public function down()
    {
        self::drop( "[class_name]" );
    }
}