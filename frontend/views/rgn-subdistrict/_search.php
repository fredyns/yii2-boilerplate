<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\search\RgnSubdistrict $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="rgn-subdistrict-search">

	<?php

	$form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
	]);

	?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'status') ?>

	<?= $form->field($model, 'name') ?>

	<?= $form->field($model, 'district_id') ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
