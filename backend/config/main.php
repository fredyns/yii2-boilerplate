<?php

$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
	'id'					 => 'app-backend',
	'basePath'				 => dirname(__DIR__),
	'controllerNamespace'	 => 'backend\controllers',
	'bootstrap'				 => ['log'],
	'modules'				 => [
		'user' => [
			'enableUnconfirmedLogin' => FALSE,
			// following line will restrict access to profile, recovery, registration and settings controllers from backend
			'as backend'			 => 'dektrium\user\filters\BackendFilter',
		],
	],
	'components'			 => [
		/* / disable default user component, using dektrium/user instead
		  'user'			 => [
		  'identityClass'		 => 'common\models\User',
		  'enableAutoLogin'	 => true,
		  ],
		  // */
		//*/ config sample for dektrium/user
		'user'			 => [
			'identityCookie' => [
				'name'		 => '_backendIdentity',
				'httpOnly'	 => true,
				// replace with your backend app relative to domain
				'path'		 => '/yii2-boilerplate/backend/web/',
			],
		],
		//*/ config sample for separate backend session
		'session'		 => [
			'name'			 => 'BACKENDSESSID',
			'cookieParams'	 => [
				'httpOnly'	 => true,
				// replace with your backend app relative to domain
				'path'		 => '/yii2-boilerplate/backend/web/',
			],
		],
		'log'			 => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets'	 => [
				[
					'class'	 => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'errorHandler'	 => [
			'errorAction' => 'site/error',
		],
	/*
	  'urlManager' => [
	  'enablePrettyUrl' => true,
	  'showScriptName' => false,
	  'rules' => [
	  ],
	  ],
	 */
	],
	'params'				 => $params,
];
