<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\RgnDistrict $model
 */
$this->title = 'Region District ' . $model->name . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Region Districts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>
<div class="giiant-crud rgn-district-update">

    <p>
		<?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . 'View', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </p>

	<?php

	echo $this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
