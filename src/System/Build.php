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
                config::app_path().'/'.$module.'/',
                config::app_path().'/'.$module.'/controller/',
                config::app_path().'/'.$module.'/model/',
                config::app_path().'/'.$module.'/view/',
            );
            foreach ($dirs as $dir){
                if(!is_dir($dir)){
                    mkdir($dir,0755,true);
                    // $filename= 'index.html';
                    // file_put_contents($dir.$filename,'');
                }
            }
        }else{
            exit('应用目录['.config::app_path().']不可写，目录无法自动生成！<BR>请手动生成项目目录~');
        }
    }


    // 创建控制器类
    static public function buildController($module,$controller='Index') {
        $file   =   config::app_path().'/'.$module.'/controller/'.$controller.'.php';
        if(!is_file($file)){
            $content = file_get_contents(config::get('controller_path'));
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

    // 创建模型类
    static public function buildModel($module,$model,$tempPath=false) {
        if( $tempPath==false ) $tempPath = config::get('model_path');
        $file   =   config::app_path().'/'.$module.'/model/'.$model.'.php';
        if(!is_file($file)){
            $content = file_get_contents( $tempPath );
            $content = str_replace(array('[MODULE]','[MODEL]'),array($module,$model),$content);
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

    static public function buildResource($module,$controller='Index'){
        $file   =   config::app_path().'/'.$module.'/controller/'.$controller.'.php';
        if(!is_file($file)){
            $content = file_get_contents(config::get('resource_path'));
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
    static public function buildInput($module,$controller='Index',$tempPath=false){
        if( $tempPath==false ) $tempPath = config::get('input_path');
        $file   =   config::app_path().'/'.$module.'/input/'.$controller.'.php';
        if(!is_file($file)){
            $content = file_get_contents($tempPath);
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
    static public function buildBehaviors($module,$controller){
        $tempPath = config::get('behaviors_path');
        $file   =   config::app_path().'/'.$module.'/behaviors/'.$controller.'.php';
        if(!is_file($file)){
            $content = file_get_contents($tempPath);
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