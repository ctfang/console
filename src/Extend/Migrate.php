<?php
namespace Console\Extend;

use Console\System;

use Console\config;

/**
 * Created by PhpStorm.
 * User: 007
 * Date: 2016/8/8
 * Time: 11:23
 */
class Migrate
{
    static public function migrate(){
        $dir = config::database().'/migrations/';
        $file=scandir($dir);
        unset($file[0]);unset($file[1]);
        foreach ($file as $name) {
            $name      = pathinfo($name)['filename'];
            $namespace = 'Console\\Database\\Migrations\\'.$name;
            $obj       = new $namespace();
            $obj->up();
            echo "\ncreate $name successfully";
        }
    }
}