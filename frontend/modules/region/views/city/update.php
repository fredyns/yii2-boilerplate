<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\modules\region\models\City $model
 */
$this->title = 'City ' . $model->name . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Region', 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>
<div class="giiant-crud city-update">

    <p>
		<?= $model->operation->button('view'); ?>
    </p>

	<?php

	echo $this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
