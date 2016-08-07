<?php
namespace Commands;
/**
* 数据库迁移命令行
*/
class Git implements \RouteModelInterface
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
    static public function git_push( $parameter ){
        if( empty($parameter) ){
            $add_str = 'git add .';
        }else{
            $add_str = 'git add '.reset($parameter);
        }
        system($add_str);
        fwrite(STDOUT, "Enter your push remark:");
        $remark = trim(fgets(STDIN));
        if( empty($remark) ) return "\033[0;41;1m remark is null";
        system('git commit -m"'.$remark.'"');
        system('git push origin master');
    }
    static public function git_pull( $parameter ){
        system('git pull origin master');
    }
}