<?php
namespace database\migrations;
require_once __APP__.'/Commands/migrate/MigrationModel.php';
class users extends \MigrationModel
{
    public function up()
    {
        $sql = <<<sql
CREATE TABLE `auth_agent_info` (
FirstName varchar(15),
LastName varchar(15),
Age int
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
sql;
        $this->create_table( $sql );
    }
    
    public function down()
    {
        $this->delete_table( "users" );
    }
}