<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\search\ReligionSearch;

/**
 * @var yii\web\View $this
 * @var frontend\models\search\ReligionSearch $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="religion-search">

	<?php

	$form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
	]);

	?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'recordStatus')->dropDownList(ReligionSearch::optsRecordStatus()); ?>

	<?= $form->field($model, 'name') ?>

	<?php // echo $form->field($model, 'created_at') ?>

	<?php // echo $form->field($model, 'updated_at') ?>

	<?php // echo $form->field($model, 'deleted_at')  ?>

	<?php // echo $form->field($model, 'createdBy_id')  ?>

	<?php // echo $form->field($model, 'updatedBy_id') ?>

	<?php // echo $form->field($model, 'deletedBy_id')  ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
