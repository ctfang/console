<?php
// 加载函数
require_once __APP__.'/Bootstrap/function.php';
// 加载，自动注册
require_once __APP__.'/Bootstrap/auth_autoload.php';
// 加载命令路由注册容器
require_once __APP__.'/Bootstrap/Container.php';
// 加载Thinkphp分析类
require_once __APP__.'/Bootstrap/Thinkphp.php';
// 加载接口
require_once __APP__.'/Bootstrap/RouteModelInterface.php';
// 加载路由文件
require_once __APP__.'/route.php';
