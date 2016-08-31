## 简介

为TP添加命令行支持

## 仿Laravel artisan 命令

在项目根目录运行cmd
php artisan route:list 就可以看到所有命令支持

这些命令支持包括：

*  显示命令列表
*  创建模块
*  创建控制器
*  创建视图
*  创建model
*  创建目录
*  创建文件
*  数据表迁移

## 自定义和目录

# 入口文件放到根目录

#!/usr/bin/php
<?php
// cli 模式运行
require './vendor/autoload.php';
// 配置读取有数据库信息的配置文件
Console\config::set('config_path','./config/db.php');
// 配置tp代码根目录
Console\config::set('app_path','./Application/');
// 开始执行
$statuc = Console\Start::run( $argv );

echo $statuc;
echo "\033[0m";
