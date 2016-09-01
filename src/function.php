<?php
/**
 * 打印无限个参数
 */
function p(){
    $args=func_get_args();
    foreach($args as $value){
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
}

/**
 * 调用分层获取参数（参数池）
 * 默认调用当前控制器当前方法
 * @param string $name 方法名
 * @param string $con 控制器名称
 * @param string $app 模块
 * @return array
 */
function input($name='',$con='',$app=''){
    if( empty($app) ) $app = MODULE_NAME;
    if( empty($con) ) $con = CONTROLLER_NAME;
    if( empty($name) ) $name = ACTION_NAME;
    $return = call_user_func ( '\\'.$app.'\\Input\\'.$con."Input".'::'.$name);
    if( $return['error_code']===0 ){
        return $return['data'];
    }
    die('ERROR:'.$return['error_data']);
}