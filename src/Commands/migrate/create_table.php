<?php
namespace database\migrations;
require_once __APP__.'/Commands/migrate/MigrationModel.php';
class [class_name] extends \MigrationModel
{
    /**
     * 创建数据表
     * @return [type] [description]
     */
    public function up()
    {
        $sql = <<<sql
CREATE TABLE IF NOT EXISTS `[class_name]` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '数据创建时间',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='新增表';
sql;
        $this->create_table( $sql );
    }
    /**
     * 删除数据表
     * @return [type] [description]
     */
    public function down()
    {
        $this->delete_table( "[class_name]" );
    }
    /**
     * 发送填充数据
     * [arr_insert 标识刷新填充键值
     * @return [type] [description]
     */
    public function seed()
    {
        // INSERT INTO `[class_name]` VALUES ([arr_insert]);
        $sql = <<<sql
sql;
        $this->insert( $sql );
    }
}