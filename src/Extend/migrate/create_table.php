<?php
namespace Console\Database\Migrations;

use Console\System\Migration;

class [class_name] extends Migration
{
    /**
     * 创建数据表
     * @return void
     */
    public function up()
    {
        self::create('[class_name]','[class_name]备注',function(){return "
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '数据创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
        "});
    }
    /**
     * 删除数据表
     * @return void
     */
    public function down()
    {
        self::drop( "[class_name]" );
    }
}