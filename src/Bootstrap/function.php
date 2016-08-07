<?php
function autoload_all($class_name){
    if( is_file( __APP__.'/Commands/'.$class_name.'.php' ) ){
        require_once __APP__.'/Commands/'.$class_name.'.php';
    }elseif( is_file( __APP__.'/'.$class_name.'.php' ) ){
        require_once __APP__.'/'.$class_name.'.php';
    }else{
        
        $file = __TP__.'Library/'.$class_name.'.class.php';
        if( is_file( $file ) ){
            require_once $file;
        }else{
            $class_name = substr($class_name, 0,-1);
            $file = __TP__.'Library/'.$class_name.'.class.php';
            require_once $file;
        }
        
    }
    
}