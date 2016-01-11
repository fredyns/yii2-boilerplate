<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var frontend\models\RgnPostcode $model
 */
$this->title = 'Region Postcode ' . $model->id . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Region Postcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';

?>
<div class="giiant-crud rgn-postcode-update">

    <p>
		<?= $model->operation->button('view'); ?>
    </p>

	<?php

	echo $this->render('_form', [
		'model' => $model,
	]);

	?>

</div>
