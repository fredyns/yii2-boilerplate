<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;
use common\widgets\Moderation;
use frontend\modules\region\models\access\PostcodeAccess;

/**
 * @var yii\web\View $this
 * @var frontend\modules\region\models\Postcode $model
 */
$this->title = 'Postcode ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Region', 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => 'Postcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';

?>
<div class="giiant-crud postcode-view">

    <!-- menu buttons -->
    <p class='pull-left'>
		<?= $model->operation->button('update'); ?>
		<?= PostcodeAccess::button('create'); ?>
    </p>
    <p class="pull-right">
		<?= PostcodeAccess::button('index'); ?>
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
				<?= $model->postcode ?>
			</h2>
        </div>

        <div class="panel-body">



			<?php $this->beginBlock('Postcode'); ?>

			<?=

			DetailView::widget([
				'model'		 => $model,
				'attributes' => [
					'id',
					'postcode',
					[
						'format'	 => 'html',
						'attribute'	 => 'subdistrict',
						'value'		 => ($model->subdistrict ? $model->subdistrict->linkTo : '<span class="label label-warning">?</span>'),
					],
					[
						'format'	 => 'html',
						'attribute'	 => 'district_id',
						'value'		 => ($model->district ? $model->district->linkTo : '<span class="label label-warning">?</span>'),
					],
					[
						'format'	 => 'html',
						'attribute'	 => 'city_id',
						'value'		 => ($model->city ? $model->city->linkTo : '<span class="label label-warning">?</span>'),
					],
					[
						'format'	 => 'html',
						'attribute'	 => 'province_id',
						'value'		 => ($model->province ? $model->province->linkTo : '<span class="label label-warning">?</span>'),
					],
					[
						'format'	 => 'html',
						'attribute'	 => 'district_id',
						'value'		 => ($model->country ? $model->country->linkTo : '<span class="label label-warning">?</span>'),
					],
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
							'content'	 => $this->blocks['Postcode'],
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
