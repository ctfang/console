<?php
namespace Console\System;

use Console\config;
/**
 * Created by PhpStorm.
 * User: selden1992
 * Date: 2016/8/7
 * Time: 12:32
 */
class Build {

    static protected $controller   =   '<?php
namespace [MODULE]\Controller;
use Think\Controller;
class [CONTROLLER]Controller extends Controller {

}';

    static protected $model         =   '<?php
namespace [MODULE]\Model;
use Think\Model;
class [MODEL]Model extends Model {

}';
    // 检测应用目录是否需要自动创建
    static public function checkDir($module){
        if(!is_dir(config::app_path().$module)) {
            // 创建模块的目录结构
            self::buildAppDir($module);
        }
    }

    // 创建应用和模块的目录结构
    static public function buildAppDir($module) {
        // 没有创建的话自动创建
        if(!is_dir(config::app_path())) mkdir(config::app_path(),0755,true);
        if(is_writeable(config::app_path())) {
            $dirs  = array(
                config::app_path().'/',
                config::app_path().'/Common/',
                config::app_path().'/'.$module.'/',
                config::app_path().'/'.$module.'/Common/',
                config::app_path().'/'.$module.'/Controller/',
                config::app_path().'/'.$module.'/Model/',
                config::app_path().'/'.$module.'/Conf/',
                config::app_path().'/'.$module.'/View/',
            );
            foreach ($dirs as $dir){
                if(!is_dir($dir))  mkdir($dir,0755,true);
            }
            // 写入目录安全文件
            self::buildDirSecure($dirs);

            // 生成模块的测试控制器
            if(defined('BUILD_CONTROLLER_LIST')){
                // 自动生成的控制器列表（注意大小写）
                $list = explode(',',BUILD_CONTROLLER_LIST);
                foreach($list as $controller){
                    self::buildController($module,$controller);
                }
            }else{
                // 生成默认的控制器
                self::buildController($module);
            }
            // 生成模块的模型
            if(defined('BUILD_MODEL_LIST')){
                // 自动生成的控制器列表（注意大小写）
                $list = explode(',',BUILD_MODEL_LIST);
                foreach($list as $model){
                    self::buildModel($module,$model);
                }
            }
        }else{
            exit('应用目录['.config::app_path().']不可写，目录无法自动生成！<BR>请手动生成项目目录~');
        }
    }


    // 创建控制器类
    static public function buildController($module,$controller='Index') {
        $file   =   config::app_path().'/'.$module.'/Controller/'.$controller.'Controller'.'.class.php';
        if(!is_file($file)){
            $content = str_replace(array('[MODULE]','[CONTROLLER]'),array($module,$controller),self::$controller);
            if( false ){
                $content    =   preg_replace('/namespace\s(.*?);/','',$content,1);
            }
            $dir = dirname($file);
            if(!is_dir($dir)){
                mkdir($dir, 0755, true);
            }
            file_put_contents($file,$content);
        }
    }

    // 创建模型类
    static public function buildModel($module,$model) {
        $file   =   config::app_path().'/'.$module.'/Model/'.$model.'Model'.'.class.php';
        if(!is_file($file)){
            $content = str_replace(array('[MODULE]','[MODEL]'),array($module,$model),self::$model);
            if( false ){
                $content    =   preg_replace('/namespace\s(.*?);/','',$content,1);
            }
            $dir = dirname($file);
            if(!is_dir($dir)){
                mkdir($dir, 0755, true);
            }
            file_put_contents($file,$content);
        }
    }

    // 生成目录安全文件
    static public function buildDirSecure($dirs=array()) {
        // 目录安全写入（默认开启）
        defined('BUILD_DIR_SECURE')  or define('BUILD_DIR_SECURE',    true);
        if(BUILD_DIR_SECURE) {
            defined('DIR_SECURE_FILENAME')  or define('DIR_SECURE_FILENAME',    'index.html');
            defined('DIR_SECURE_CONTENT')   or define('DIR_SECURE_CONTENT',     ' ');
            // 自动写入目录安全文件
            $content = DIR_SECURE_CONTENT;
            $files = explode(',', DIR_SECURE_FILENAME);
            foreach ($files as $filename){
                foreach ($dirs as $dir)
                    file_put_contents($dir.$filename,$content);
            }
        }
    }
    static public function buildResource($module,$controller='Index'){
        $file   =   config::app_path().'/'.$module.'/Controller/'.$controller.'Controller'.'.class.php';
        if(!is_file($file)){
            $content = file_get_contents( __DIR__.'/Build/Resource.tpl' );
            $content = str_replace(array('[MODULE]','[CONTROLLER]'),array($module,$controller),$content);
            if( false ){
                $content    =   preg_replace('/namespace\s(.*?);/','',$content,1);
            }
            $dir = dirname($file);
            if(!is_dir($dir)){
                mkdir($dir, 0755, true);
            }
            file_put_contents($file,$content);
        }
    }
}