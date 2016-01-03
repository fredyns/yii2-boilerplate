<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\RgnCountry $model
 */
$this->title = 'Rgn Country ' . $model->name . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Rgn Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>
<div class="giiant-crud rgn-country-update">

    <p>
		<?= $model->operation->button('view'); ?>
    </p>

	<?php

	echo $this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
