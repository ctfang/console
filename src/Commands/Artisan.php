<?php
/**
* 帮助显示
*/
class Artisan implements RouteModelInterface
{
    
    public function boot( $input ){
        $Route = Route::getInstance();
        $binds = $Route->binds;
        foreach ($binds as $key => $value) {
            echo "$key \n";
        }
    }
    fsdfgsd
fdsgsdgsdzzzz
}