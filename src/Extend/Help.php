<?php
namespace Console\Extend;

use Console\System\Route;
/**
 * Created by PhpStorm.
 * User: 007
 * Date: 2016/8/6
 * Time: 21:51
 */
class Help
{
    static public function route(){
        foreach (Route::$binds as $key => $value) {
            echo "$key \n";
        }
    }
}