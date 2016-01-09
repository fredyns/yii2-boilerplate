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
use frontend\models\access\RgnCityAccess;
use frontend\models\access\RgnDistrictAccess;
use frontend\models\access\RgnPostcodeAccess;

/**
 * @var yii\web\View $this
 * @var frontend\models\RgnCity $model
 */
$this->title = 'Region City ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Region Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string) $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';

?>
<div class="giiant-crud rgn-city-view">

    <!-- menu buttons -->
    <p class='pull-left'>
		<?= $model->operation->button('update'); ?>
		<?= RgnCityAccess::button('create'); ?>
    </p>
    <p class="pull-right">
		<?= RgnCityAccess::button('index'); ?>
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

			<?php $this->beginBlock('frontend\models\RgnCity'); ?>

			<?=

			DetailView::widget([
				'model'		 => $model,
				'attributes' => [
					'id',
					[
						'attribute'	 => 'status',
						'value'		 => $model->statusLabel,
					],
					'number',
					'name',
					'abbreviation',
					[
						'format'	 => 'html',
						'attribute'	 => 'province_id',
						'value'		 => ($model->getProvince()->one() ? $model->getProvince()->one()->operation->linkView : '<span class="label label-warning">?</span>'),
					],
					[
						'format'	 => 'html',
						'attribute'	 => 'country_id',
						'value'		 => ($model->getCountry()->one() ? $model->getCountry()->one()->operation->linkView : '<span class="label label-warning">?</span>'),
					],
				],
			]);

			?>

			<hr/>

			<?= $model->operation->button('delete'); ?>
			<?= $model->operation->button('restore'); ?>

			<?php $this->endBlock(); ?>



			<?php $this->beginBlock('RgnDistricts'); ?>
			<div style='position: relative'>
				<div style='position:absolute; right: 0px; top: 0px;'>

					<?= RgnDistrictAccess::button('index', ['label' => 'All Districts', 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

					<?= RgnDistrictAccess::button('create', ['label' => 'New District', 'urlOptions' => [ 'RgnDistrict' => ['city_id' => $model->id]], 'buttonOptions' => ['class' => 'btn btn-success btn-xs']]); ?>

				</div>
			</div>
			<?php Pjax::begin(['id' => 'pjax-RgnDistricts', 'enableReplaceState' => false, 'linkSelector' => '#pjax-RgnDistricts ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
			<?=

			'<div class="table-responsive">'
			. \yii\grid\GridView::widget([
				'layout'		 => '{summary}{pager}<br/>{items}{pager}',
				'dataProvider'	 => new \yii\data\ActiveDataProvider([
					'query'		 => $model->getRgnDistricts(),
					'pagination' => [
						'pageSize'	 => 50,
						'pageParam'	 => 'page-rgndistricts',
					],
					]),
				'pager'			 => [
					'class'			 => yii\widgets\LinkPager::className(),
					'firstPageLabel' => 'First',
					'lastPageLabel'	 => 'Last'
				],
				'columns'		 => [
					[
						'class' => 'yii\grid\SerialColumn',
					],
					'number',
					'name',
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
							'RgnPostcode' => [
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
					'lastPageLabel'	 => 'Last',
				],
				'columns'		 => [
					[
						'class' => 'yii\grid\SerialColumn',
					],
					[
						"attribute"	 => "postcode",
						"format"	 => "raw",
						"options"	 => [],
						"value"		 => function($model)
					{
						return $model->operation->linkView;
					}
					],
					[
						'attribute'	 => 'subdistrict_id',
						"format"	 => "raw",
						"options"	 => [],
						'value'		 => function ($model)
					{
						/**
						 * @var RgnSubdistrict $subdistrict
						 */
						if ($subdistrict = $model->getSubdistrict()->one())
						{
							//return Html::a($rel->name, ['rgn-subdistrict/view', 'id' => $rel->id,], ['data-pjax' => 0]);
							return $subdistrict->operation->getLinkView($subdistrict->name, ['title' => 'view subdistrict', 'data-pjax' => 0]);
						}

						return '';
					},
					],
					[
						'attribute'	 => 'district_id',
						"format"	 => "raw",
						"options"	 => [],
						'value'		 => function ($model)
					{
						/**
						 * @var RgnDistrict $district
						 */
						if ($district = $model->getDistrict()->one())
						{
							//return Html::a($rel->name, ['rgn-district/view', 'id' => $rel->id,], ['data-pjax' => 0]);
							return $district->operation->getLinkView($district->name, ['title' => 'view district', 'data-pjax' => 0]);
						}

						return '';
					},
					],
					[
						'attribute'	 => 'city_id',
						"format"	 => "raw",
						"options"	 => [],
						'value'		 => function ($model)
					{
						/**
						 * @var RgnCity $city
						 */
						if ($city = $model->getCity()->one())
						{
							//return Html::a($rel->name, ['rgn-city/view', 'id' => $rel->id,], ['data-pjax' => 0]);
							return $city->operation->getLinkView($city->name, ['title' => 'view city', 'data-pjax' => 0]);
						}

						return '';
					},
					],
					[
						'attribute'	 => 'province_id',
						"format"	 => "raw",
						"options"	 => [],
						'value'		 => function ($model)
					{
						/**
						 * @var RgnProvince $province
						 */
						if ($province = $model->getProvince()->one())
						{
							//return Html::a($rel->name, ['rgn-province/view', 'id' => $rel->id,], ['data-pjax' => 0]);
							return $province->operation->getLinkView($province->name, ['title' => 'view province', 'data-pjax' => 0]);
						}

						return '';
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
							'content'	 => $this->blocks['frontend\models\RgnCity'],
							'active'	 => true,
						],
						[
							'content'	 => $this->blocks['RgnDistricts'],
							'label'		 => '<small>Region Districts <span class="badge badge-default">' . count($model->getRgnDistricts()->asArray()->all()) . '</span></small>',
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
