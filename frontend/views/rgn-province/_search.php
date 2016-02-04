<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\search\RgnProvinceSearch;

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

	<?= $form->field($model, 'recordStatus')->dropDownList(RgnProvinceSearch::optsRecordStatus()); ?>

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
