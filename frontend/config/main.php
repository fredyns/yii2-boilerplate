<?php

$params = array_merge(
	require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
	'id'					 => 'app-frontend',
	'basePath'				 => dirname(__DIR__),
	'bootstrap'				 => ['log'],
	'controllerNamespace'	 => 'frontend\controllers',
	'components'			 => [
		/* /
		  'user'			 => [
		  'identityClass'		 => 'common\models\User',
		  'enableAutoLogin'	 => true,
		  ],
		  // */
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
		'assetManager'	 => [
			'bundles' => [
				'dmstr\web\AdminLteAsset' => [
					'skin' => 'skin-blue',
				],
			],
		],
		'session'		 => [
			'class'			 => 'yii\web\DbSession',
			// 'db' => 'mydb',
			'sessionTable'	 => 'yii_session',
		]
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
	'modules'				 => [
		'region' => [
			'class' => 'frontend\modules\region\Module',
		],
		'user'	 => [
			// following line will restrict access to admin controller from frontend application
			'as frontend' => 'dektrium\user\filters\FrontendFilter',
		],
	],
];
