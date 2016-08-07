<?php
namespace Commands;
/**
* 数据库迁移命令行
*/
class Migrate implements \RouteModelInterface
{
    
    public function boot( $input ){
        $parameter  = $input->parameter;
        $route      = $input->command;
        $arr        = explode(':', $route);
        if( isset( $arr['1'] ) ){
            $fun = $arr['1'];
        }
        $fun = isset( $arr['1'] )?$arr['0'].'_'.$arr['1']:$route;

        if ( method_exists($this,$fun) ) {
            return self::$fun($parameter);
        }
        return "\033[0;41;1mphp error function not find";
    }
    static public function make_migration( $parameter ){
        $table_name = reset( $parameter );
        if( empty($table_name) ){
            return "\033[0;41;1m table_name is null";
        }
        $filename = __APP__.'/database/migrations/'.$table_name.'.php';
        if( !is_file($filename ) ){
            $str = file_get_contents( dirname(__FILE__).'/migrate/create_table.php');
            $str = str_replace("[class_name]", $table_name, $str);
            file_put_contents($filename, $str);
            echo 'create '.$filename;
        }else{
            return "\033[0;41;1m table_name is has";
        }
    }
    static protected function migrate(){
        $dir = __APP__.'/database/migrations/';
        $file=scandir($dir);
        unset($file[0]);unset($file[1]);
        foreach ($file as $name) {
            $name      = pathinfo($name)['filename'];
            $namespace = '\\database\\migrations\\'.$name;
            $obj       = new $namespace();
            $obj->up();
            echo "\ncreate $name successfully";
        }
    }
    static protected function install(){
        self::migrate_reset();
        self::migrate();
        self::db_seed( array('all') );
    }
    static protected function migrate_refresh(){
        self::migrate_reset();
        self::migrate();
    }
    static protected function migrate_reset(){
        $dir = __APP__.'/database/migrations/';
        $file=scandir($dir);
        unset($file[0]);unset($file[1]);
        foreach ($file as $name) {
            $name      = pathinfo($name)['filename'];
            $namespace = '\\database\\migrations\\'.$name;
            $obj       = new $namespace();
            $obj->down();
            echo "\ndelete $name successfully";
        }
    }
    static protected function migrate_delete( $parameter ){
        $name = reset( $parameter );
        if( empty($name) ) if( empty($name) ) return "\033[0;41;1m table_name isnull"; 
        if( !is_file( __APP__.'/database/migrations/'.$name.'.php' ) )  return "\033[0;41;1mnot find this $name migrate"; 
        $namespace = '\\database\\migrations\\'.$name;
        $obj       = new $namespace();
        $obj->down();
        echo "\ndelete $name successfully";
    }
    static protected function db_seed( $parameter ){
        $name = reset( $parameter );
        if( empty($name) ){
            fwrite(STDOUT, "Enter all or table_name:");
            $name = trim(fgets(STDIN));
            if( empty($name) ) return "\033[0;41;1m name table is null";
        }
        if( $name=='all' ){
            $dir = __APP__.'/database/migrations/';
            $file=scandir($dir);
            unset($file[0]);unset($file[1]);
            foreach ($file as $name) {
                $name      = pathinfo($name)['filename'];
                $namespace = '\\database\\migrations\\'.$name;
                $obj       = new $namespace();
                $obj->seed();
                echo "\nseed $name successfully";
            }
        }else{
            $filename = __APP__.'/database/migrations/'.$name.'.php';
            if( !is_file( $filename ) )  return "\033[0;41;1mnot find this $name migrate";
                $namespace = '\\database\\migrations\\'.$name;
                $obj       = new $namespace();
                $obj->seed();
                echo "\nseed $name successfully";
        }
    }
    static protected function make_seeder( $parameter ){
        $name = reset( $parameter );
        if( empty($name) ) return "\033[0;41;1m table_name isnull"; 
        $filename = __APP__.'/database/migrations/'.$name.'.php';
        if( !is_file( $filename ) )  return "\033[0;41;1mnot find this $name migrate"; 
        $tp = new \Thinkphp;
        $db = $tp->get_db();
        $sql = "DESC $name";
        $result =$db->query( $sql );
        $str_sql = '';
        while($row = mysql_fetch_array($result)){
            $value = $row['Default'];
            if( empty($row['Default']) ){
                $value = $row['Field'];
            }
            if( !empty($str_sql) ){
                $str_sql = $str_sql.',';
            }
            $str_sql  = $str_sql."'$value'";
        }
        $str = file_get_contents( $filename );
        $newstr = str_replace("[arr_insert]", $str_sql, $str);
        if( $str!=$newstr)
        file_put_contents($filename, $newstr);
        echo "\ncreate $name successfully";
    }
}