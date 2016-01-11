<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;
use common\widgets\Moderation;
use frontend\models\RgnProvince;
use frontend\models\RgnCity;
use frontend\models\RgnDistrict;
use frontend\models\RgnSubdistrict;
use frontend\models\RgnPostcode;
use frontend\models\access\RgnCountryAccess;
use frontend\models\access\RgnProvinceAccess;
use frontend\models\access\RgnPostcodeAccess;

/**
 * @var yii\web\View $this
 * @var frontend\models\RgnCountry $model
 */
$this->title = 'Region Country ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Region Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';

?>
<div class="giiant-crud rgn-country-view">

    <!-- menu buttons -->
    <p class='pull-left'>
		<?= $model->operation->button('update'); ?>
		<?= RgnCountryAccess::button('create'); ?>
    </p>
    <p class="pull-right">
		<?= RgnCountryAccess::button('index'); ?>
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

			<?php $this->beginBlock('RgnCountry'); ?>

			<?=

			DetailView::widget([
				'model'		 => $model,
				'attributes' => [
					'id',
					'abbreviation',
					'name',
				],
			]);

			?>

			<hr/>

			<?= $model->operation->button('delete'); ?>
			<?= $model->operation->button('restore'); ?>

			<?php $this->endBlock(); ?>



			<?php $this->beginBlock('RgnProvinces'); ?>

			<div style='position: relative'>
				<div style='position:absolute; right: 0px; top: 0px;'>

					<?= RgnProvinceAccess::button('index', ['label' => 'All Provinces', 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

					<?= RgnProvinceAccess::button('create', ['label' => 'New Province', 'urlOptions' => [ 'RgnProvinceForm' => ['country_id' => $model->id]], 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

				</div>
			</div>

			<?php Pjax::begin(['id' => 'pjax-RgnProvinces', 'enableReplaceState' => false, 'linkSelector' => '#pjax-RgnProvinces ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
			<?=

			'<div class="table-responsive">'
			. \yii\grid\GridView::widget([
				'layout'		 => '{summary}{pager}<br/>{items}{pager}',
				'dataProvider'	 => new \yii\data\ActiveDataProvider([
					'query'		 => $model->getRgnProvinces(),
					'pagination' => [
						'pageSize'	 => 50,
						'pageParam'	 => 'page-rgnprovinces',
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
					'abbreviation',
				]
			])
			. '</div>';

			?>

			<?php Pjax::end() ?>

			<?php $this->endBlock() ?>



			<?php $this->beginBlock('RgnPostcodes'); ?>
			<div style='position: relative'>
				<div style='position:absolute; right: 0px; top: 0px;'>

					<?= RgnPostcodeAccess::button('index', ['label' => 'All Postcodes', 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

					<?= RgnPostcodeAccess::button('create', ['label' => 'New Postcode', 'urlOptions' => [ 'RgnPostcodeForm' => ['country_id' => $model->id]], 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

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
						'attribute'	 => 'province_id',
						"format"	 => "raw",
						"options"	 => [],
						'value'		 => function ($model)
					{
						return ($model->province) ? $model->province->linkTo : '<span class="label label-warning">?</span>';
					},
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
				]
			])
			. '</div>';

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
							'content'	 => $this->blocks['RgnCountry'],
							'active'	 => true,
						],
						[
							'content'	 => $this->blocks['RgnProvinces'],
							'label'		 => '<small>Region Provinces <span class="badge badge-default">' . count($model->getRgnProvinces()->asArray()->all()) . '</span></small>',
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
