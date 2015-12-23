<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\Religion $model
 */
$this->title = 'Religion ' . $model->name . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Religions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>
<div class="giiant-crud religion-update">

    <p>
		<?= $model->operation->button('view'); ?>
    </p>

	<?php

	echo $this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
