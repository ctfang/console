<?php
/**
* 模型命令行
*/
class Module implements RouteModelInterface
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
    static public function make_module( $parameter ){
        $module = reset( $parameter );
        if( empty($module) ){
            fwrite(STDOUT, "Enter your module name: ");
            $module = trim(fgets(STDIN));
            if( empty($module) ) return "\033[0;41;1m module name is null";
        }
        require_once __APP__.'/vendor/Build.class.php';
        $buil = new Think\Build;
        $buil::buildAppDir( $module );
    }
}