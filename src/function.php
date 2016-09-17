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