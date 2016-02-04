<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\region\models\search\CountrySearch;

/**
 * @var yii\web\View $this
 * @var frontend\modules\region\models\search\CountrySearch $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="country-search">

	<?php

	$form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
	]);

	?>

	<?= $form->field($model, 'id') ?>

	<?= $form->field($model, 'recordStatus')->dropDownList(CountrySearch::optsRecordStatus()); ?>

	<?= $form->field($model, 'name') ?>

	<?= $form->field($model, 'abbreviation') ?>

	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
