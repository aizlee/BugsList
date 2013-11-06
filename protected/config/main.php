<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'defaultController'=>'tickets',
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
        'application.extensions.imperaviRedactorWidget*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        	'application.modules.rights.models.*',
        	'application.modules.rights.components.*',
        'application.modules.comments.*',
	         'application.modules.comments.models.*',
	        'application.modules.comments.controller.*',
	),
       
       
	'modules'=>array(
		'rights',
		 'comments'=>array(
		        //you may override default config for all connecting models
		        'defaultModelConfig' => array(
		            //only registered users can post comments
		            'registeredOnly' => false,
		            'useCaptcha' => false,
		            //allow comment tree
		            'allowSubcommenting' => true,
		            //display comments after moderation
		            'premoderate' => false,
		            //action for postig comment
		            'postCommentAction' => 'comments/comment/postComment',
		            //super user condition(display comment list in admin view and automoderate comments)
		            'isSuperuser'=>'Yii::app()->user->checkAccess("moderate")',
		            //order direction for comments
		            'orderComments'=>'ASC',
		        ),
		        //the models for commenting
		        'commentableModels'=>array(
		            //model with individual settings
		            'Tickets'=>array(
		                'registeredOnly'=>true,
		                'useCaptcha'=>false,
		                'allowSubcommenting'=>false,
		                //config for create link to view model page(page with comments)
		                'pageUrl'=>array(
		                    'route'=>'admin/citys/view',
		                    'data'=>array('id'=>'city_id'),
		                ),
		            ),
		            //model with default settings
		            'ImpressionSet',
		        ),
		        //config for user models, which is used in application
		        'userConfig'=>array(
		            'class'=>'User',
		            'nameProperty'=>'username',
		            'emailProperty'=>'email',
		        ),
		    ),
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
                    'class' => 'bootstrap.BootStrapModule',
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

	 'widgetFactory' => array(
	            'widgets' => array(
	                'ERedactorWidget' => array(
	                    'options'=>array(
	                        'lang'=>'ru',
	                        'buttons'=>array(
	                            'formatting', '|', 'bold', 'italic', 'deleted', '|',
	                            'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
	                            'image', 'video', 'link', '|', 'html',
	                        ),
	                    ),
	                ),
	            ),
	        ),

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
			'connectionString' => 'mysql:host=localhost;dbname=Tickets',
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