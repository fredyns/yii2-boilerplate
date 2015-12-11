<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use common\models\RgnCountry;

/**
 * @var yii\web\View $this
 * @var common\models\RgnSubdistrict $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
			<?= $model->name ?>
		</h2>
    </div>

    <div class="panel-body">

        <div class="rgn-subdistrict-form">

			<?php

			$form = ActiveForm::begin([
					'id'					 => 'RgnSubdistrict',
					'layout'				 => 'horizontal',
					'enableClientValidation' => true,
					'errorSummaryCssClass'	 => 'error-summary alert alert-error'
					]
			);

			?>

            <div class="">
				<?php $this->beginBlock('main'); ?>

                <p>

					<?= $form->field($model, 'id')->textInput(['readonly' => 'readonly', 'placeholder' => 'auto']) ?>
					<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

					<?php

					echo $form
						->field($model, 'district_id')
						->widget(DepDrop::classname(), [
							'data'			 => [],
							'type'			 => DepDrop::TYPE_SELECT2,
							'select2Options' => [
								'pluginOptions' => [
									'multiple'			 => FALSE,
									'allowClear'		 => TRUE,
									'tags'				 => TRUE,
									'maximumInputLength' => 255, /* city name maxlength */
								],
							],
							'pluginOptions'	 => [
								'initialize'	 => true,
								'placeholder'	 => 'Select or type district',
								'depends'		 => ['rgnsubdistrict-city_id'],
								'url'			 => Url::to([
									'/rgn-district/depdrop-options',
									'selected' => $model->district_id,
								]),
								'loadingText'	 => 'Loading districts ...',
							],
					]);

					echo $form
						->field($model, 'city_id')
						->widget(DepDrop::classname(), [
							'data'			 => [],
							'type'			 => DepDrop::TYPE_SELECT2,
							'select2Options' => [
								'pluginOptions' => [
									'multiple'			 => FALSE,
									'allowClear'		 => TRUE,
									'tags'				 => TRUE,
									'maximumInputLength' => 255, /* city name maxlength */
								],
							],
							'pluginOptions'	 => [
								'initialize'	 => true,
								'placeholder'	 => 'Select or type city',
								'depends'		 => ['rgnsubdistrict-province_id'],
								'url'			 => Url::to([
									'/rgn-city/depdrop-options',
									'selected' => $model->city_id,
								]),
								'loadingText'	 => 'Loading cities ...',
							],
					]);

					echo $form
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
								'initialize'	 => true,
								'placeholder'	 => 'Select or type province',
								'depends'		 => ['rgnsubdistrict-country_id'],
								'url'			 => Url::to([
									'/rgn-province/depdrop-options',
									'selected' => $model->province_id,
								]),
								'loadingText'	 => 'Loading provinces ...',
							],
					]);

					echo $form
						->field($model, 'country_id')
						->widget(Select2::classname(), [
							'data'			 => RgnCountry::asOption(),
							'pluginOptions'	 => [
								'placeholder'		 => 'Select or type country',
								'multiple'			 => FALSE,
								'allowClear'		 => TRUE,
								'tags'				 => TRUE,
								'maximumInputLength' => 255, /* country name maxlength */
							],
					]);

					?>

                </p>

				<?php $this->endBlock(); ?>

				<?=

				Tabs::widget(
					[
						'encodeLabels'	 => false,
						'items'			 => [
							[
								'label'		 => 'RgnSubdistrict',
								'content'	 => $this->blocks['main'],
								'active'	 => true,
							],
						],
					]
				);

				?>
                <hr/>
				<?php echo $form->errorSummary($model); ?>
				<?=

				Html::submitButton(
					'<span class="glyphicon glyphicon-check"></span> ' .
					($model->isNewRecord ? 'Create' : 'Save'), [
					'id'	 => 'save-' . $model->formName(),
					'class'	 => 'btn btn-success'
					]
				);

				?>

				<?php ActiveForm::end(); ?>

            </div>

        </div>

    </div>

</div>
