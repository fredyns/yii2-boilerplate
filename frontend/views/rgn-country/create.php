<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\RgnCountry $model
 */
$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Region Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="giiant-crud rgn-country-create">

    <p class="pull-left">
		<?= Html::a('Cancel', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
    </p>
    <div class="clearfix"></div>

	<?=

	$this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
