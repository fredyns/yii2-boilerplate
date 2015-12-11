<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\RgnPostcode $model
 */
$this->title = 'Region Postcode ' . $model->id . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Region Postcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>
<div class="giiant-crud rgn-postcode-update">

    <p>
		<?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . 'View', ['view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </p>

	<?php

	echo $this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
