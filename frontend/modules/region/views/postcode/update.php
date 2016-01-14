<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\modules\region\models\Postcode $model
 */
$this->title = 'Postcode ' . $model->id . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Region', 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => 'Postcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>
<div class="giiant-crud postcode-update">

    <p>
		<?= $model->operation->button('view'); ?>
    </p>

	<?php

	echo $this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
