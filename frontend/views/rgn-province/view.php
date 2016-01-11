<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;
use frontend\models\access\RgnProvinceAccess;
use frontend\models\access\RgnCityAccess;
use frontend\models\access\RgnPostcodeAccess;
use common\widgets\Moderation;

/**
 * @var yii\web\View $this
 * @var frontend\models\RgnProvince $model
 */
$this->title = 'Region Province ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Region Provinces', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';

?>
<div class="giiant-crud rgn-province-view">

    <!-- menu buttons -->
    <p class='pull-left'>
		<?= $model->operation->button('update'); ?>
		<?= RgnProvinceAccess::button('create'); ?>
    </p>
    <p class="pull-right">
		<?= RgnProvinceAccess::button('index'); ?>
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



			<?php $this->beginBlock('RgnProvince'); ?>

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
						'attribute'	 => 'country_id',
						'value'		 => ($model->country) ? $model->country->linkTo : '<span class="label label-warning">?</span>',
					],
				],
			]);

			?>

			<hr/>

			<?= $model->operation->button('delete'); ?>
			<?= $model->operation->button('restore'); ?>

			<?php $this->endBlock(); ?>



			<?php $this->beginBlock('RgnCities'); ?>

			<div style='position: relative'>
				<div style='position:absolute; right: 0px; top: 0px;'>

					<?= RgnCityAccess::button('index', ['label' => 'All Cities', 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

					<?=

					RgnCityAccess::button('create', [
						'label'			 => 'New City',
						'urlOptions'	 => [
							'RgnCityForm' => [
								'country_id'	 => $model->country_id,
								'province_id'	 => $model->id,
							],
						],
						'buttonOptions'	 => ['class' => 'btn btn-success btn-xs'],
					]);

					?>

				</div>
			</div>

			<?php Pjax::begin(['id' => 'pjax-RgnCities', 'enableReplaceState' => false, 'linkSelector' => '#pjax-RgnCities ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
			<?=

			'<div class="table-responsive">'
			. \yii\grid\GridView::widget([
				'layout'		 => '{summary}{pager}<br/>{items}{pager}',
				'dataProvider'	 => new \yii\data\ActiveDataProvider([
					'query'		 => $model->getRgnCities(),
					'pagination' => [
						'pageSize'	 => 50,
						'pageParam'	 => 'page-rgncities',
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
					'abbreviation',
				]
			])
			. '</div>'

			?>
			<?php Pjax::end() ?>
			<?php $this->endBlock() ?>


			<?php $this->beginBlock('RgnPostcodes'); ?>
			<div style='position: relative'>
				<div style='position:absolute; right: 0px; top: 0px;'>

					<?= RgnPostcodeAccess::button('index', ['label' => 'All Postcodes', 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

					<?=

					RgnPostcodeAccess::button('create', [
						'label'			 => 'New Postcode',
						'urlOptions'	 => [
							'RgnPostcodeForm' => [
								'country_id'	 => $model->country_id,
								'province_id'	 => $model->id,
							],
						],
						'buttonOptions'	 => ['class' => 'btn btn-success btn-xs'],
					]);

					?>

				</div>
			</div>

			<?php Pjax::begin(['id' => 'pjax-RgnPostcodes', 'enableReplaceState' => false, 'linkSelector' => '#pjax-RgnPostcodes ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
			<?=

			'<div class="table-responsive">'
			. \yii\grid\GridView::widget([
				'layout'		 => '{summary}{pager}<br/>{items}{pager}',
				'dataProvider'	 => new \yii\data\ActiveDataProvider([
					'query'		 => $model->getRgnPostcodes(),
					'pagination' => [
						'pageSize'	 => 50,
						'pageParam'	 => 'page-rgnpostcodes',
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
						'attribute'	 => 'city_id',
						"format"	 => "raw",
						"options"	 => [],
						'value'		 => function ($model)
					{
						return ($model->city) ? $model->city->linkTo : '<span class="label label-warning">?</span>';
					},
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
				],
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
							'content'	 => $this->blocks['RgnProvince'],
							'active'	 => true,
						],
						[
							'content'	 => $this->blocks['RgnCities'],
							'label'		 => '<small>Region Cities <span class="badge badge-default">' . count($model->getRgnCities()->asArray()->all()) . '</span></small>',
							'active'	 => false,
						],
						[
							'content'	 => $this->blocks['RgnPostcodes'],
							'label'		 => '<small>Region Postcodes <span class="badge badge-default">' . count($model->getRgnPostcodes()->asArray()->all()) . '</span></small>',
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
