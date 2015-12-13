<?php

use yii\helpers\Html;
use yii\helpers\Url;
use cornernote\returnurl\ReturnUrl;

/**
 * @var yii\web\View $this
 * @var common\models\RgnProvince $model
 */
$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Region Provinces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="giiant-crud rgn-province-create">

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