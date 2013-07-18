<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'QRPedia',

    'language' => 'ru',

    'preload' => array('log'),

    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.yii-mail.*',
    ),

    'modules' => array(

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),

    ),

    'components' => array(

        'user' => array(
            'class' => 'WebUser',
        ),

        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'transportType' => 'php',
            'viewPath' => 'application.views.email',
            'logging' => true,
            'dryRun' => false
        ),

        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                'gii' => 'gii',
                'gii/<controller:\w+>' => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',

                'login' => 'auth/login',
                'register' => 'auth/register',
                'restore' => 'auth/restore',
                'restore/<code:\w+>' => 'auth/restore/code/<code>',
                'logout' => 'auth/logout',

                'buy_package' => 'profile/buy_package',

                'move' => 'adverts/move',
                'add_folder' => 'adverts/add_folder',
                'load_folder' => 'adverts/load_folder',
                'save_folder' => 'adverts/save_folder',
                'delete_folder' => 'adverts/delete_folder',

                'item' => 'adverts/item',
                'item/<id:\d+>' => 'adverts/item/id/<id>',
                'item/view/<id:\d+>' => 'adverts/view/id/<id>',

                'companies/item/<id:\d+>' => 'companies/item/id/<id>',

                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view/id/<id>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            )
        ),

        'db' => require(dirname(__FILE__) . '/db.php'),

        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),

    ),


    'params' => array(
        'from_email' => 'admin@admin.ru',
        'upload_dir' => '/uploads/',
        'qrcodes_dir' => '/uploads/qr/',
    ),
);