<?php
namespace Console\Extend;

use Console\System\Route;

// 命令帮助列表
Route::register('route:list',function(){
    return Help::route();
});

// 创建模块
Route::register('make:module',function(){
    return Make::module();
});

// make控制器
Route::register('make:controller',function(){
    return Make::controller();
});

// make model
Route::register('make:model',function(){
    return Make::model();
});

// make 视图
Route::register('make:view',function(){
    return Make::view();
});

// 创建数据表迁移文件
Route::register('make:migration',function(){
    return Make::migration();
});
