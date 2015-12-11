<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var frontend\models\search\RgnPostcode $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="rgn-postcode-search">

	<?php

	$form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
	]);

	?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'postcode') ?>

	<?= $form->field($model, 'subdistrict_id') ?>

	<?= $form->field($model, 'district_id') ?>

	<?= $form->field($model, 'city_id') ?>

	<?php // echo $form->field($model, 'province_id') ?>

	<?php // echo $form->field($model, 'country_id')  ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
