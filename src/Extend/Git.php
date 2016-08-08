<?php
namespace Console\Extend;

use Console\config;
/**
 * Created by PhpStorm.
 * User: 007
 * Date: 2016/8/8
 * Time: 10:00
 */
class Git
{
    static public function push_all(){
        chdir("vendor/selden1992/console");
        self::add();
        self::push();
    }
    static public function add(){
        $parameter = config::param();
        if( empty($parameter) ){
            $add_str = 'git add .';
        }else{
            $add_str = 'git add '.reset($parameter);
        }
        system($add_str);
    }
    static public function push(){
        fwrite(STDOUT, "Enter your push remark:");
        $remark = trim(fgets(STDIN));
        if( empty($remark) ) return "\033[0;41;1m remark is null";
        system('git commit -m"'.$remark.'"');
        system('git push origin master');
    }
}