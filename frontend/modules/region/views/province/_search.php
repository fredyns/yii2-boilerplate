<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\region\models\search\ProvinceSearch;

/**
 * @var yii\web\View $this
 * @var frontend\modules\region\models\search\ProvinceSearch $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="province-search">

	<?php

	$form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
	]);

	?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'recordStatus')->dropDownList(ProvinceSearch::optsRecordStatus()); ?>

	<?= $form->field($model, 'number') ?>

	<?= $form->field($model, 'name') ?>

	<?= $form->field($model, 'abbreviation') ?>

	<?=

		$form
		->field($model, 'country_id')
		->widget(Select2::classname(), [
			'data'			 => RgnCountry::asOption(),
			'pluginOptions'	 =>
			[
				'placeholder'		 => 'Select or type Country',
				'multiple'			 => FALSE,
				'allowClear'		 => TRUE,
				'tags'				 => TRUE,
				'maximumInputLength' => 255, /* country name maxlength */
			],
	]);

	?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
