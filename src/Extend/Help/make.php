<?php
return [
    'title'=>'创建命令',

    'module'=>[
        'title'=>'创建模块',
        'parameter'=>'module',
        'details'=>[],
    ],

    'controller'=>[
        'title'=>'创建控制器',
        'parameter'=>'module\\controller',
        'details'=>[
            '--resource'=>'创建资源类型控制器',
        ],
    ],

    'model'=>[
        'title'=>'创建模型',
        'parameter'=>'module\\model',
        'details'=>[],
    ],

    'view'=>[
        'title'=>'创建view试图',
        'parameter'=>'module\\model\\view',
        'details'=>[],
    ],
    'migration'=>[
        'title'=>'创建迁移文件',
        'parameter'=>'file name',
        'details'=>[],
    ],
    'seeder'=>[
        'title'=>'数据表填充文件',
        'parameter'=>'nothing',
        'details'=>[
            'table'=>'表名称',
        ],
    ],
];