<?php

use yii\helpers\Html;
use yii\helpers\Url;
use cornernote\returnurl\ReturnUrl;

/**
 * @var yii\web\View $this
 * @var frontend\models\Religion $model
 */
$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Religions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="giiant-crud religion-create">

    <p class="pull-left">
		<?= Html::a('Cancel', ReturnUrl::getUrl(Url::previous()), ['class' => 'btn btn-default']) ?>
    </p>
    <div class="clearfix"></div>

	<?=

	$this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
