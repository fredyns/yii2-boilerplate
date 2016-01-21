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

			<hr/>
			<div id="map" style="margin-top: 50px;">

				<?php

				$address = "{$model->name}, " . (($model->country) ? $model->country->name : "");
				$title = $model->name;

				?>
				<h3>Map</h3>

				<style>
					#map-canvas {
						width:100%;
						height:400px;
						border:solid #999 1px;
					}
				</style>
				<div id="map-position"></div>
				<div id="map-canvas"></div>

				<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
				<script type="text/javascript">

					var map;
					var geocoder;
					var marker;
					var markersArray = [];
					var myLatlng = new google.maps.LatLng(-6.176655999999999, 106.83058389999997);
					var mapOptions = {
						center: myLatlng,
						zoom: 5
					};

					geocoder = new google.maps.Geocoder();
					map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

					geocoder.geocode({'address': '<?= $address ?>'}, function (results, status)
					{
						if (status === google.maps.GeocoderStatus.OK)
						{
							var position = results[0].geometry.location;

							map.setCenter(results[0].geometry.location);
							marker = new google.maps.Marker({
								'map': map,
								'position': results[0].geometry.location,
								'title': '<?= $title ?>'
							});
							markersArray.push(marker);


							document.getElementById("map-position").innerHTML = 'Lat: ' + position.lat() + '; Long: ' + position.lng();
						}
						else
						{
							document.getElementById("map-position").innerHTML = 'Geocode was not successful for the following reason: ' + status;
						}
					});
				</script>

			</div>

		</div>

	</div>

	<br/>

	<?= Moderation::widget(['model' => $model]); ?>

</div>
