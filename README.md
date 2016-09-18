## 简介

为TP添加命令行支持，数据迁移文件的模板是以mysql5.7为例，低版本自行修改模板路径，console.php配置文件，
欢迎push你的代码

master为开发分支

2.* 分支支持tp3.2

tp5.* 分支支持tp5

## 这些命令支持包括( src/route.php注册了所有命令,自行查看 )

*  允许新增自定义命令
*  允许覆盖默认命令
*  显示命令列表
*  创建模块
*  创建控制器
*  创建视图
*  创建model
*  创建目录
*  创建文件
*  数据表迁移
*  创建参数池
*  创建行为类

### 开始安装包
修改thinkphp5根目录下的composer.json文件里面的

require 和 scripts 标签

    {
        "require": {
            "php": ">=5.4.0",
            "topthink/framework": "^5.0",
            "selden1992/console":"dev-tp5.0"
        },
        "scripts": {

            "post-autoload-dump": [
                "php -r \"file_exists('artisan') || copy('./vendor/selden1992/console/artisan','artisan');\""
            ]
        }
    }

命令行下运行以下命令开始安装
    
    composer update

根目录下会生成 artisan 文件 充当入口文件，没有可以手动创建

    #!/usr/bin/php
    <?php
    // cli 模式运行
    require './vendor/autoload.php';
    // 读取配置文件
    Console\config::setAll( './application/console.php' );
    // ----------------begin 新增命令或覆盖默认命令----------------------
    // 覆盖命令
    // Console\System\Route::register('make:controller',function(){
    //     echo 'make:controller ----- ok';
    // });
    // -----------------end 新增命令或覆盖默认命令 ---------------------
    
    // 开始执行
    $back = Console\Start::run( $argv );
    
    echo $back;
    echo "\033[0m";

# 命令行下
查看帮助命令

    php artisan

创建空控制器

    php artisan make:controller index/test
    
创建资源控制器

    php artisan make:controller index/test --resource
    
创建数据表

    php artisan make:migration users
    // 创建数据表记录文件，在根目录下database/migrations/
    php artisan magrate
    // 开始写入数据库

其他
    
   





