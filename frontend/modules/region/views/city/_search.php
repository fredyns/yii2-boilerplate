<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use frontend\modules\region\models\Country;
use frontend\modules\region\models\search\CitySearch;

/**
 * @var yii\web\View $this
 * @var frontend\modules\region\models\search\CitySearch $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="city-search">

	<?php

	$form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
	]);

	?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'recordStatus')->dropDownList(CitySearch::optsRecordStatus()); ?>

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
				'depends'		 => ['citysearch-country_id'],
				'url'			 => Url::to([
					'/region/province/depdrop-options',
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
			'data'			 => Country::asOption(),
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
