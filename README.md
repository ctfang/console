# PHP 命令行功能

# 入口文件
#!/usr/bin/php
<?php
// cli 模式运行
require './vendor/autoload.php';

Console\Start::run( $argv );
