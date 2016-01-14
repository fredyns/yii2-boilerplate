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
 * @var frontend\modules\region\models\City $model
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

        <div class="city-form">

			<?php

			$form = ActiveForm::begin([
					'id'					 => 'City',
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

					<?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'abbreviation')->textInput(['maxlength' => true]) ?>

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
								'depends'		 => ['cityform-country_id'],
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
								'label'		 => 'City',
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
