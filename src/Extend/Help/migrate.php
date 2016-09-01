<?php
return [
    'title'=>'数据迁移命令',

    'rollback'=>[
        'title'=>'返回上一次迁移',
        'parameter'=>'file name',
        'details'=>[],
    ],

    'reset'=>[
        'title'=>'还原数据库',
        'parameter'=>'nothing',
        'details'=>[

        ],
    ],

    'refresh'=>[
        'title'=>'还原数据库并且重新迁移',
        'parameter'=>'nothing',
        'details'=>[
            '--seed'=>'并且填充数据',
        ],
    ],

];