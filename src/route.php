<?php
namespace Console\Extend;

use Console\System\Route;

// 命令帮助列表
Route::register('',function(){
    return Help::route();
});

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

// 创建一个迁移库文件
Route::register('make:migration',function(){
    return Make::migration();
});
// 创建数据插入文件
Route::register('make:seeder',function(){
    return Make::seeder();
});
// 创建input文件
Route::register('make:input',function(){
    return Make::input();
});
// 创建行为文件
Route::register('make:behaviors',function(){
    return Make::behaviors();
});
// 提交 git
Route::register('git:push',function(){
    return Git::push_all();
});
// 运行迁移
Route::register('migrate',function(){
    return Migrate::migrate();
});
// 还原应用程序中的所有迁移：
Route::register('migrate:reset',function(){
    return Migrate::reset();
});
// 回滚所有迁移并且再执行一次：
Route::register('migrate:refresh',function(){
    return Migrate::refresh();
});
// 回滚所有迁移并且再执行一次：
Route::register('db:seed',function(){
    return Db::seed();
});
