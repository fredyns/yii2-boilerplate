<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\search\RgnCitySearch;
use frontend\models\RgnCountry;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;

/**
 * @var yii\web\View $this
 * @var frontend\models\search\RgnCitySearch $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="rgn-city-search">

	<?php

	$form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
	]);

	?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'recordStatus')->dropDownList(RgnCitySearch::optsRecordStatus()); ?>

	<?= $form->field($model, 'number') ?>

	<?= $form->field($model, 'name') ?>

	<?= $form->field($model, 'abbreviation') ?>

	<?=

		$form
		->field($model, 'province_id')
		->widget(DepDrop::classname(), [
			'data'			 => [],
			'type'			 => DepDrop::TYPE_SELECT2,
			'select2Options' => [
				'pluginOptions' => [
					'multiple'			 => FALSE,
					'allowClear'		 => TRUE,
					'tags'				 => TRUE,
					'maximumInputLength' => 255, /* province name maxlength */
				],
			],
			'pluginOptions'	 => [
				'initialize'	 => TRUE,
				'placeholder'	 => 'Select or type province',
				'depends'		 => ['rgncitysearch-country_id'],
				'url'			 => Url::to([
					'/rgn-province/depdrop-options',
					'selected' => $model->province_id,
				]),
				'loadingText'	 => 'Loading provinces ...',
			],
	]);

	?>
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
