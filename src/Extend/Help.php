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
            $arr = explode(':',$key);
            if( isset($arr[1]) ){
                $list[$arr[0]][] = $arr[1];
            }else{
                $list['default'] = [];
            }
        }


        foreach ($list as $key => $value) {
            $filePath = __DIR__.'/Help/'.$key.'.php';
            if( file_exists($filePath) ){
                /** @noinspection PhpIncludeInspection */
                $arr = require $filePath;
                echo $key,self::space($key),iconv('utf-8','gbk',$arr['title']),"\n";
                if( is_array($value) ) {
                    foreach ($value as $console) {
                        echo '    :',$console,self::space($console,16),$arr[$console]['parameter'],self::space($arr[$console]['parameter'],20),iconv('utf-8','gbk',$arr[$console]['title']),"\n";
                        foreach ($arr[$console]['details'] as $kk=>$item){
                            echo self::space('',21),'[',$kk,"]",self::space($kk,18),iconv('utf-8','gbk',$item),"\n";
                        }
                    }
                }
            }
        }
    }
    static public function space($string,$allSpace=21){
        $space  = '';
        $stolen = strlen($string);
        if( $stolen>=$allSpace ){
            return "\n                    ";
        }else{
            $num   = $allSpace-$stolen;
            for ($num;$num>=1;--$num){
                $space = $space.' ';
            }
        }
        return $space;
    }
}