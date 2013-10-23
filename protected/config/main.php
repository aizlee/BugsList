<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
       /* 'aliases' => array(
                    'bootstrap' => 'application.modules.bootstrap',
                    //'bootstrap' => dirname(__FILE__). '/../modules/bootstrap',
            ),*/
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.extensions.*',
                'application.modules.user.models.*',
                'application.modules.user.components.*',
                'application.modules.rights.*',
                'application.modules.rights.models.*',
                'application.modules.rights.components.*',
                'application.modules.bootstrap.components.*',
                'application.modules.bootstrap.*',
                'application.modules.bootstrap.widgets.*',
                'application.modules.bootstrap.models.*',
                'application.modules.bootstrap.helpers.*',
                'application.modules.bootstrap.extensions.*',
                'application.modules.bootstrap.assets.*'
	),
       
        'theme'=>'classic',
	'modules'=>array(
		'rights',
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111',
                        'generatorPaths'=>array(
                            'bootstrap.gii',
                        ),
                         // If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
		),
                'bootstrap' => array(
                    'class' => 'bootstrap.BootStrapModule'
                ),
                                
                'user'=>array(
                # encrypting method (php hash function)
                'hash' => 'md5',

                # send activation email
                'sendActivationMail' => true,

                # allow access for non-activated users
                'loginNotActiv' => false,

                # activate user on registration (only sendActivationMail = false)
                'activeAfterRegister' => false,

                # automatically login from registration
                'autoLogin' => true,

                # registration path
                'registrationUrl' => array('/user/registration'),

                # recovery password path
                'recoveryUrl' => array('/user/recovery'),

                # login form path
                'loginUrl' => array('/user/login'),

                # page after login
                'returnUrl' => array('/user/profile'),

                # page after logout
                'returnLogoutUrl' => array('/user/login'),
            ),
                
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
                        'class' => 'RWebUser',
                        'allowAutoLogin'=>true,
                        'loginUrl' => array('/user/login'),
                    ),
		 'authManager'=>array(
		        'class'=>'RDbAuthManager',
		        'defaultRoles' => array('Guest') // дефолтная роль
		    ),
               'bsHtml' => array(
                    'class' => 'bootstrap.components.BSHtml'
                ),
                     'bootstrap'=>array(
                        'class'=>'bootstrap.components.Bootstrap',
                    ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=BugsList',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '123',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
    
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);