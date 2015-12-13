<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var common\models\RgnCountry $model
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

        <div class="rgn-country-form">

			<?php

			$form = ActiveForm::begin([
					'id'					 => 'RgnCountry',
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
					<?= $form->field($model, 'abbreviation')->textInput(['maxlength' => true]) ?>
                </p>

				<?php $this->endBlock(); ?>

				<?=

				Tabs::widget(
					[
						'encodeLabels'	 => false,
						'items'			 => [
							[
								'label'		 => 'RgnCountry',
								'content'	 => $this->blocks['main'],
								'active'	 => true,
							],
						]
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
