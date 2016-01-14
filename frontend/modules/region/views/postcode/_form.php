<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use dmstr\bootstrap\Tabs;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use frontend\modules\region\models\Country;

/**
 * @var yii\web\View $this
 * @var frontend\modules\region\models\Postcode $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
			<?= $model->id ?>
		</h2>
    </div>

    <div class="panel-body">

        <div class="postcode-form">

			<?php

			$form = ActiveForm::begin([
					'id'					 => 'Postcode',
					'layout'				 => 'horizontal',
					'enableClientValidation' => true,
					'errorSummaryCssClass'	 => 'error-summary alert alert-error'
					]
			);

			?>

            <div class="">
				<?php $this->beginBlock('main'); ?>

                <p>

					<?= $form->field($model, 'id')->textInput(['disabled' => 'disabled', 'placeholder' => 'autonumber']) ?>

					<?= $form->field($model, 'postcode')->textInput() ?>

					<?=

						$form
						->field($model, 'subdistrict_id')
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
								'placeholder'	 => 'Select or type subdistrict',
								'depends'		 => ['postcodeform-district_id'],
								'url'			 => Url::to([
									'/region/subdistrict/depdrop-options',
									'selected' => $model->subdistrict_id,
								]),
								'loadingText'	 => 'Loading subdistricts ...',
							],
					]);

					?>
					<?=

						$form
						->field($model, 'district_id')
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
								'placeholder'	 => 'Select or type district',
								'depends'		 => ['postcodeform-city_id'],
								'url'			 => Url::to([
									'/region/district/depdrop-options',
									'selected' => $model->district_id,
								]),
								'loadingText'	 => 'Loading districts ...',
							],
					]);

					?>
					<?=

						$form
						->field($model, 'city_id')
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
								'placeholder'	 => 'Select or type city',
								'depends'		 => ['postcodeform-province_id'],
								'url'			 => Url::to([
									'/region/city/depdrop-options',
									'selected' => $model->city_id,
								]),
								'loadingText'	 => 'Loading cities ...',
							],
					]);

					?>
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
								'depends'		 => ['postcodeform-country_id'],
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

                </p>
				<?php $this->endBlock(); ?>

				<?=

				Tabs::widget(
					[
						'encodeLabels'	 => false,
						'items'			 => [
							[
								'label'		 => 'Postcode',
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
