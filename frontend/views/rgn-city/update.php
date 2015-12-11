<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\RgnCity $model
 */
$this->title = 'Region City ' . $model->name . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Region Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>
<div class="giiant-crud rgn-city-update">

    <p>
		<?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . 'View', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </p>

	<?php

	echo $this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
