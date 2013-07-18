<?php

require_once(dirname(__FILE__) . '/../components/helpers.php');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Leadmama.ru',

    'preload' => array('log'),

    'language' => 'ru',

    'import' => array(
        'application.models.*',
        'application.models.forms.*',
        'application.components.*',
        'application.extensions.yii-mail.*',
    ),

    'modules' => array(

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            'ipFilters' => array('127.0.0.1', '::1'),
        ),

        'admin',

    ),

    // application components
    'components' => array(

        'user' => array(
            'class' => 'WebUser',
			'allowAutoLogin' => true,
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
                'logout' => 'user/logout',
                'login' => 'user/login',
				'restore' => 'user/restore',
				'restore/<code:\w+>' => 'user/restore/code/<code>',
                'register/invite/<invite:\w+>' => 'user/register/invite/<invite>',
                'register' => 'user/register',
                'weight/*<id:\d*>' => 'growth/weight/baby_id/<id>',
                'height/*<id:\d*>' => 'growth/height/baby_id/<id>',
                'teeth/*<id:\d*>' => 'growth/teeth/baby_id/<id>',
				'news' => 'site/news_list',
                'news/<id:\d+>' => 'site/news/id/<id>',
                'page/<alias:\w+>' => 'site/page/alias/<alias>',
                'news/<id:\d+>' => 'site/news/id/<id>',
                'tooth/<num:\d+>' => 'growth/tooth/num/<num>',
                'weight/chart/<id:\d*>' => 'growth/chart/type/weight/baby_id/<id>',
                'height/chart/<id:\d*>' => 'growth/chart/type/height/baby_id/<id>',
                'diary/<id:\d+>' => 'diary/index/id/<id>',
                'diary/item/<id:\d+>' => 'diary/item/id/<id>',
				'diary/user/<id:\d+>' => 'diary/index/id/<id>',
                'diary/comment/<id:\d+>' => 'diary/comment/id/<id>',
                'baby' => 'baby/index',
                'baby/firstday' => 'baby/index/firstday/1',
                'baby/<id:\d+>' => 'baby/index/firstday/0/baby_id/<id>',
                'baby/<id:\d+>/firstday' => 'baby/index/firstday/1/baby_id/<id>',
                'medicine' => 'health/medicine',
                'calendar' => 'calendar/index',
                'calendar/<id:\d*>' => 'calendar/index/baby_id/<id>',
                'feeding' => 'health/feeding/baby_id/0',
                'feeding/<id:\d*>' => 'health/feeding/baby_id/<id>',
                'feeding/delete/<id:\d+>' => 'health/delete_feeding/id/<id>',
                'feeding/edit' => 'health/edit_feeding/id/0',
                'feeding/edit/<id:\d*>' => 'health/edit_feeding/id/<id>',
                'medicine/delete/<id:\d+>' => 'health/delete_record/id/<id>',
                'medicine/<id:\d+>' => 'health/medicine/id/<id>',
                'vaccination/delete/<id:\d+>' => 'health/delete_vaccination/id/<id>',
                'medicine/edit/<id:\d+>' => 'health/edit_record/id/<id>',
                'vaccination/edit/<id:\d+>' => 'health/edit_vaccination/id/<id>',
                'gallery/<id:\d+>' => 'gallery/index/baby_id/<id>',
                'gallery/delete/<id:\d+>' => 'gallery/delete/id/<id>',
                'gallery/like/<id:\d+>' => 'gallery/like/id/<id>',
                'gallery/photo/<id:\d+>' => 'gallery/photo/id/<id>',
                'gallery/view/<id:\d+>' => 'gallery/view/id/<id>',

                'open_access' => 'user/open_access',

                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
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

        'upload_user_dir' => '/uploads/user/',
        'upload_baby_dir' => '/uploads/baby/',
        'upload_diary_dir' => '/uploads/diary/',
        'upload_gallery_dir' => '/uploads/gallery/',
        'upload_news_dir' => '/uploads/news/',

        'nophoto_user' => '/images/nophoto_user.jpg',
        'nophoto_baby' => '/images/nophoto_user.jpg',
		
		'email_admin' => 'admin@leadmama.ru',
    ),
);