<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;
use frontend\models\access\ReligionAccess;
use common\widgets\Moderation;

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
		<?= $model->operation->button('update'); ?>
		<?= ReligionAccess::button('create'); ?>
    </p>
    <p class="pull-right">
		<?= ReligionAccess::button('index'); ?>
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
				<?= $model->name ?>
            </h2>
        </div>

        <div class="panel-body">

			<?php $this->beginBlock('Religion'); ?>

			<?=

			DetailView::widget([
				'model'		 => $model,
				'attributes' => [
					'id',
					[
						'attribute'	 => 'status',
						'value'		 => $model->statusLabel,
					],
					'name',
				],
			]);

			?>

			<hr/>

			<?= $model->operation->button('delete'); ?>
			<?= $model->operation->button('restore'); ?>

			<?php $this->endBlock(); ?>

			<?=

			Tabs::widget(
				[
					'id'			 => 'relation-tabs',
					'encodeLabels'	 => false,
					'items'			 => [
						[
							'label'		 => '<b class=""># ' . $model->id . '</b>',
							'content'	 => $this->blocks['Religion'],
							'active'	 => true,
						],
					],
				]
			);

			?>

        </div>
    </div>

	<br/>
	<?= Moderation::widget(['model' => $model]); ?>

</div>
