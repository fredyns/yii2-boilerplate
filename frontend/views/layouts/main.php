<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login')
{
	/**
	 * Do not use this code in your template. Remove it.
	 * Instead, use the code  $this->layout = '//main-login'; in your controller.
	 */
	echo $this->render(
		'main-login', ['content' => $content]
	);
}
else
{

	if (class_exists('backend\assets\AppAsset'))
	{
		backend\assets\AppAsset::register($this);
	}
	else
	{
		app\assets\AppAsset::register($this);
	}

	dmstr\web\AdminLteAsset::register($this);

	$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

	?>
	<?php $this->beginPage() ?>
	<!DOCTYPE html>
	<html lang="<?= Yii::$app->language ?>">
		<head>
			<meta charset="<?= Yii::$app->charset ?>"/>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<?= Html::csrfMetaTags() ?>
			<title><?= Html::encode($this->title) ?></title>
			<?php $this->head() ?>
		</head>
		<body class="skin-blue sidebar-mini">
			<?php $this->beginBody() ?>
			<div class="wrapper">

				<?= $this->render('header.php', ['directoryAsset' => $directoryAsset]) ?>

				<?= $this->render(((Yii::$app->user->isGuest) ? 'left-public.php' : 'left-user.php'), ['directoryAsset' => $directoryAsset]) ?>

				<?= $this->render('content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]) ?>

			</div>

			<?php $this->endBody() ?>

			<script>
				window.fbAsyncInit = function () {
					FB.init({
						appId: '910117462416938',
						xfbml: true,
						version: 'v2.5'
					});
				};

				(function (d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {
						return;
					}
					js = d.createElement(s);
					js.id = id;
					js.src = "//connect.facebook.net/en_US/sdk.js";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>

		</body>
	</html>
	<?php $this->endPage() ?>
<?php } ?>
