<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\search\RgnProvinceSearch $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="rgn-province-search">

	<?php

	$form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
	]);

	?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'status') ?>

	<?= $form->field($model, 'number') ?>

	<?= $form->field($model, 'name') ?>

	<?= $form->field($model, 'abbreviation') ?>

	<?=

	$form->field($model, 'country_id')->dropDownList(
		\frontend\models\RgnCountry::asOption(), ['prompt' => 'Select']
	);

	?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
