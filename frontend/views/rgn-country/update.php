<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\RgnCountry $model
 */
$this->title = 'Region Country ' . $model->name . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Region Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>
<div class="giiant-crud rgn-country-update">

    <p>
		<?= $model->menu->button('view'); ?>
	</p>

	<?php

	echo $this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
