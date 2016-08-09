# PHP 命令行功能

# 入口文件
#!/usr/bin/php
<?php
// cli 模式运行
require './vendor/autoload.php';
// 配置读取有数据库信息的配置文件
Console\config::set('config_path','./Application/Common/Conf/config.php');
// 配置tp代码根目录
Console\config::set('app_path','./Application/');
// 开始执行
$statuc = Console\Start::run( $argv );

echo $statuc;
