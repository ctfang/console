<?php
/**
* 模型命令行
*/
class Model implements RouteModelInterface
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
        echo "\033[0;41;1mphp error function not find";
    }
    static public function make_model( $parameter ){
        $arr = explode("\\",reset($parameter) );
        if( empty($arr[0]) || empty($arr[1]) ){
            return "\033[0;41;1m module name is null;Enter module/model";
        }
        require_once __APP__.'/vendor/Build.class.php';
        $buil = new Think\Build;
        $buil::buildModel( $arr['0'],$arr[1] );
    }
}