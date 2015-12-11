<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var frontend\models\Religion $model
 */
$this->title = 'Religion ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Religions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';

?>
<div class="giiant-crud religion-view">

    <!-- menu buttons -->
    <p class='pull-left'>
		<?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . 'Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
		<?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . 'New', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p class="pull-right">
		<?= Html::a('<span class="glyphicon glyphicon-list"></span> ' . 'List Religions', ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <div class="clearfix"></div>

    <!-- flash message -->
	<?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
		<span class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			<?= \Yii::$app->session->getFlash('deleteError') ?>
		</span>
	<?php endif; ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>
				<?= $model->name ?>            </h2>
        </div>

        <div class="panel-body">



			<?php $this->beginBlock('frontend\models\Religion'); ?>

			<?=

			DetailView::widget([
				'model'		 => $model,
				'attributes' => [
					'id',
					[
						'attribute'	 => 'status',
						'value'		 => frontend\models\Religion::getStatusValueLabel($model->status),
					],
					'name',
				],
			]);

			?>

			<hr/>

			<?=

			Html::a('<span class="glyphicon glyphicon-trash"></span> ' . 'Delete', ['delete', 'id' => $model->id], [
				'class'			 => 'btn btn-danger',
				'data-confirm'	 => '' . 'Are you sure to delete this item?' . '',
				'data-method'	 => 'post',
			]);

			?>
			<?php $this->endBlock(); ?>



			<?=

			Tabs::widget(
				[
					'id'			 => 'relation-tabs',
					'encodeLabels'	 => false,
					'items'			 => [ [
							'label'		 => '<b class=""># ' . $model->id . '</b>',
							'content'	 => $this->blocks['frontend\models\Religion'],
							'active'	 => true,
						],]
				]
			);

			?>

			<br/><br/>

			<?= \common\widgets\Moderation::widget(['model' => $model]); ?>

        </div>
    </div>
</div>
