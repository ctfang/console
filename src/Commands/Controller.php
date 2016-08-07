<?php
/**
* 模型命令行
*/
class Controller implements RouteModelInterface
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
    static public function make_controller( $parameter ){
        $arr = explode("\\",reset($parameter) );
        if( empty($arr[0]) || empty($arr[1]) ){
            return "\033[0;41;1m module name is null;Enter module/controller";
        }
        require_once __APP__.'/vendor/Build.class.php';
        $buil = new Think\Build;
        $buil::buildController( $arr['0'],$arr[1] );
    }
    static public function make_view( $parameter ){
        $arr = explode("\\",reset($parameter) );
        if( empty($arr[0]) || empty($arr[1]) || empty($arr[2]) ){
            return "\033[0;41;1m module name is null;Enter module/view_dir/html_name";
        }
        $file_path = __TP_APP__.$arr[0].'/View/'.$arr[1].'/'.$arr[2];
        if(!is_dir(dirname($file_path)))  mkdir(dirname($file_path),0755,true);
        file_put_contents( $file_path,'创建成功');
    }
}