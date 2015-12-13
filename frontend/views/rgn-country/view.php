<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;
use frontend\models\menu\RgnCountryMenu;

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
		<?= $model->menu->button('update'); ?>
		<?= RgnCountryMenu::btn('create'); ?>
	</p>

    <p class="pull-right">
		<?= $model->menu->button('index'); ?>
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

			<?php $this->beginBlock('frontend\models\RgnCountry'); ?>

			<?=

			DetailView::widget([
				'model'		 => $model,
				'attributes' => [
					'id',
					'name',
					'abbreviation',
				],
			]);

			?>

			<hr/>

			<?= $model->menu->button('delete'); ?>

			<?php $this->endBlock(); ?>



			<?php $this->beginBlock('RgnProvinces'); ?>
			<div style='position: relative'>
				<div style='position:absolute; right: 0px; top: 0px;'>
					<?=

					Html::a(
						'<span class="glyphicon glyphicon-list"></span> ' . 'List All' . ' Region Provinces', ['rgn-province/index'], ['class' => 'btn text-muted btn-xs']
					)

					?>
					<?=

					Html::a(
						'<span class="glyphicon glyphicon-plus"></span> ' . 'New' . ' Region Province', ['rgn-province/create', 'RgnProvince' => ['country_id' => $model->id]], ['class' => 'btn btn-success btn-xs']
					);

					?>
				</div>
			</div>

			<?php Pjax::begin(['id' => 'pjax-RgnProvinces', 'enableReplaceState' => false, 'linkSelector' => '#pjax-RgnProvinces ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>
			<?=

			'<div class="table-responsive">' . \yii\grid\GridView::widget([
				'layout'		 => '{summary}{pager}<br/>{items}{pager}',
				'dataProvider'	 => new \yii\data\ActiveDataProvider(['query' => $model->getRgnProvinces(), 'pagination' => ['pageSize' => 20, 'pageParam' => 'page-rgnprovinces']]),
				'pager'			 => [
					'class'			 => yii\widgets\LinkPager::className(),
					'firstPageLabel' => 'First',
					'lastPageLabel'	 => 'Last'
				],
				'columns'		 => [
					[
						'class'		 => 'yii\grid\SerialColumn',
						'options'	 => [
							'width' => '40px',
						],
					],
					//'name',
					[
						"class"		 => \yii\grid\DataColumn::className(),
						"attribute"	 => 'name',
						"format"	 => "raw",
						"options"	 => [],
						"value"		 => function($model)
					{
						return $model->menu->anchor('view', $model->name);
					},
					],
					'abbreviation',
					[
						"label"		 => 'Action',
						"class"		 => \yii\grid\DataColumn::className(),
						"options"	 => [
							"width" => "120px",
						],
						"format"	 => "raw",
						"value"		 => function($model)
					{
						return $model->menu->widgetDropdown();
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
							'content'	 => $this->blocks['frontend\models\RgnCountry'],
							'active'	 => true,
						],
						[
							'content'	 => $this->blocks['RgnProvinces'],
							'label'		 => '<small>Region Provinces <span class="badge badge-default">' . count($model->getRgnProvinces()->asArray()->all()) . '</span></small>',
							'active'	 => false,
						],
					]
				]
			);

			?>

			<br/><br/>

			<?= \common\widgets\Moderation::widget(['model' => $model]); ?>

        </div>

    </div>
</div>
