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
        $parameter  = config::param();
        $git_dir    = $parameter[0];
        if (!empty($git_dir)){
            chdir("vendor/{$git_dir}");
        }
        self::add();
        self::push();
    }
    static public function add(){
        $add_str = 'git add .';
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