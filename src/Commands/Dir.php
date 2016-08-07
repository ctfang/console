<?php
/**
* 模型命令行
*/
class Dir implements RouteModelInterface
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
    static public function make_dir( $parameter ){
        $dir = reset($parameter);
        if( empty($dir) ){
            return "\033[0;41;1m dirname name is null;Enter dir/dir/";
        }
        $dir = __WWW__.'/'.$dir;
        if(!is_dir($dir))  mkdir($dir,0755,true);
    }
    static public function make_file( $parameter ){
        $path = reset($parameter);
        if( empty($path) ){
            return "\033[0;41;1m dirname name is null;Enter dir/dir/filename";
        }
        $path = __WWW__.'/'.$path;
        $dir  = dirname($path);
        if(!is_dir($dir))  mkdir($dir,0755,true);
        if(!is_file($path))  file_put_contents($path,'');
    }
}