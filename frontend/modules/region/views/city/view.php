<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;
use common\widgets\Moderation;
use frontend\modules\region\models\access\CityAccess;
use frontend\modules\region\models\access\DistrictAccess;
use frontend\modules\region\models\access\PostcodeAccess;

/**
 * @var yii\web\View $this
 * @var frontend\modules\region\models\City $model
 */
$this->title = 'City ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Region', 'url' => ['/region']];
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';

?>
<div class="giiant-crud city-view">

    <!-- menu buttons -->
    <p class='pull-left'>
		<?= $model->operation->button('update'); ?>
		<?= CityAccess::button('create'); ?>
    </p>
    <p class="pull-right">
		<?= CityAccess::button('index'); ?>
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



			<?php $this->beginBlock('City'); ?>

			<?=

			DetailView::widget([
				'model'		 => $model,
				'attributes' => [
					'id',
					'number',
					'abbreviation',
					'name',
					[
						'format'	 => 'html',
						'attribute'	 => 'province_id',
						'value'		 => ($model->province ? $model->province->linkTo : '<span class="label label-warning">?</span>'),
					],
					[
						'format'	 => 'html',
						'attribute'	 => 'country_id',
						'value'		 => ($model->country ? $model->country->linkTo : '<span class="label label-warning">?</span>'),
					],
				],
			]);

			?>

			<hr/>

			<?= $model->operation->button('delete'); ?>
			<?= $model->operation->button('restore'); ?>

			<?php $this->endBlock(); ?>



			<?php $this->beginBlock('Districts'); ?>

			<div style='position: relative'>
				<div style='position:absolute; right: 0px; top: 0px;'>

					<?= DistrictAccess::button('index', ['label' => 'All Districts', 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

					<?=

					DistrictAccess::button('create', [
						'label'			 => 'New District',
						'urlOptions'	 => [
							'DistrictForm' => [
								'country_id'	 => $model->country_id,
								'province_id'	 => $model->province_id,
								'city_id'		 => $model->id,
							],
						],
						'buttonOptions'	 => ['class' => 'btn btn-success btn-xs'],
					]);

					?>

				</div>
			</div>
			<?php Pjax::begin(['id' => 'pjax-Districts', 'enableReplaceState' => false, 'linkSelector' => '#pjax-Districts ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
			<?=

			'<div class="table-responsive">'
			. \yii\grid\GridView::widget([
				'layout'		 => '{summary}{pager}<br/>{items}{pager}',
				'dataProvider'	 => new \yii\data\ActiveDataProvider([
					'query'		 => $model->getDistricts(),
					'pagination' => [
						'pageSize'	 => 50,
						'pageParam'	 => 'page-districts',
					],
					]),
				'pager'			 => [
					'class'			 => yii\widgets\LinkPager::className(),
					'firstPageLabel' => 'First',
					'lastPageLabel'	 => 'Last',
				],
				'columns'		 => [
					[
						'class'		 => 'yii\grid\SerialColumn',
						"options"	 => [
							"width" => "50px",
						],
					],
					'number',
					[
						"attribute"	 => "name",
						"format"	 => "raw",
						"options"	 => [],
						"value"		 => function($model)
					{
						return $model->linkTo;
					}
					],
				],
			])
			. '</div>'

			?>
			<?php Pjax::end() ?>
			<?php $this->endBlock() ?>


			<?php $this->beginBlock('Postcodes'); ?>

			<div style='position: relative'>
				<div style='position:absolute; right: 0px; top: 0px;'>

					<?= PostcodeAccess::button('index', ['label' => 'All Postcodes', 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

					<?=

					PostcodeAccess::button('create', [
						'label'			 => 'New Postcode',
						'urlOptions'	 => [
							'PostcodeForm' => [
								'country_id'	 => $model->country_id,
								'province_id'	 => $model->province_id,
								'city_id'		 => $model->id,
							],
						],
						'buttonOptions'	 => ['class' => 'btn btn-success btn-xs'],
					]);

					?>

				</div>
			</div>

			<?php Pjax::begin(['id' => 'pjax-Postcodes', 'enableReplaceState' => false, 'linkSelector' => '#pjax-Postcodes ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
			<?=

			'<div class="table-responsive">'
			. \yii\grid\GridView::widget([
				'layout'		 => '{summary}{pager}<br/>{items}{pager}',
				'dataProvider'	 => new \yii\data\ActiveDataProvider([
					'query'		 => $model->getPostcodes(),
					'pagination' => [
						'pageSize'	 => 50,
						'pageParam'	 => 'page-postcodes',
					],
					]),
				'pager'			 => [
					'class'			 => yii\widgets\LinkPager::className(),
					'firstPageLabel' => 'First',
					'lastPageLabel'	 => 'Last'
				],
				'columns'		 => [
					[
						'class'		 => 'yii\grid\SerialColumn',
						"options"	 => [
							"width" => "50px",
						],
					],
					[
						"attribute"	 => "postcode",
						"format"	 => "raw",
						"options"	 => [],
						"value"		 => function($model)
					{
						return $model->linkTo;
					}
					],
					[
						'attribute'	 => 'district_id',
						"format"	 => "raw",
						"options"	 => [],
						'value'		 => function ($model)
					{
						return ($model->district) ? $model->district->linkTo : '<span class="label label-warning">?</span>';
					},
					],
					[
						'attribute'	 => 'subdistrict_id',
						"format"	 => "raw",
						"options"	 => [],
						'value'		 => function ($model)
					{
						return ($model->subdistrict) ? $model->subdistrict->linkTo : '<span class="label label-warning">?</span>';
					},
					],
				]
			])
			. '</div>'

			?>
			<?php Pjax::end() ?>
			<?php $this->endBlock() ?>


			<?=

			Tabs::widget(
				[
					'id'			 => 'relation-tabs',
					'encodeLabels'	 => false,
					'items'			 => [
						[
							'label'		 => '<b class=""># ' . $model->id . '</b>',
							'content'	 => $this->blocks['City'],
							'active'	 => true,
						],
						[
							'content'	 => $this->blocks['Districts'],
							'label'		 => '<small>Districts <span class="badge badge-default">' . count($model->getDistricts()->asArray()->all()) . '</span></small>',
							'active'	 => false,
						],
						[
							'content'	 => $this->blocks['Postcodes'],
							'label'		 => '<small>Postcodes <span class="badge badge-default">' . count($model->getPostcodes()->asArray()->all()) . '</span></small>',
							'active'	 => false,
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
