<?php
namespace Console;

/**
* 入口类
*/
class Start
{
    static public function run($argv){
        $console    = $argv[1];

        unset($argv[0]);
        unset($argv[1]);

        $param      = array_values( $argv );

        config::set('console',$console);
        config::set('param',$param);

        $route      = new System\Route();
        return $route->make( $console,$param );
    }
}