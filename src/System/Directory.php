<?php
namespace Console\System;

/**
 * Created by PhpStorm.
 * User: 007
 * Date: 2016/8/8
 * Time: 14:02
 */
class Directory
{
    static public function explode($dir){
        $arr = explode(DIRECTORY_SEPARATOR,$dir );
        if( empty($arr[1]) )  $arr = explode("/",$dir );
        return $arr;
    }
}