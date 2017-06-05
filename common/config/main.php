<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'th',
    'modules' => [
        'user' => [ //module id = 'user' only
            'class' => 'anda\user\Module',
            'loginBy' => 'db', //db or ldap
            'userUploadDir' => '@uploads', //real path
            'userUploadUrl' => '/uploads', //url path
            'userUploadPath' => 'user', //path after upload directory
            'admins' => ['admin', 'root'] //list username for manage users
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
    ],
];
