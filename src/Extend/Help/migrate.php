<?php
return [
    'title'=>'数据迁移命令',

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