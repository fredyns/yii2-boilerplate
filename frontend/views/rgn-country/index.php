<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use frontend\models\menu\RgnCountryMenu;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\search\RgnCountry $searchModel
 */
$this->title = 'Region > Countries';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="giiant-crud rgn-country-index">

	<?php //     echo $this->render('_search', ['model' =>$searchModel]);

	?>

    <div class="clearfix">
        <p class="pull-left">
			<?= RgnCountryMenu::btn('create'); ?>
		</p>

        <div class="pull-right">
			<?= RgnCountryMenu::btn('deleted'); ?>


			<?=

			\yii\bootstrap\ButtonDropdown::widget(
				[
					'id'			 => 'giiant-relations',
					'encodeLabel'	 => false,
					'label'			 => '<span class="glyphicon glyphicon-paperclip"></span> ' . 'Relations',
					'dropdown'		 => [
						'options'		 => [
							'class' => 'dropdown-menu-right'
						],
						'encodeLabels'	 => false,
						'items'			 => [ [
								'url'	 => ['rgn-postcode/index'],
								'label'	 => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . 'Region Postcode' . '</i>',
							], [
								'url'	 => ['rgn-province/index'],
								'label'	 => '<i class="glyphicon glyphicon-arrow-right">&nbsp;' . 'Region Province' . '</i>',
							],]
					],
					'options'		 => [
						'class' => 'btn-default'
					]
				]
			);

			?>
		</div>
    </div>


	<?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>
				<i><?= $this->title ?></i>
			</h2>
		</div>

		<div class="panel-body">

			<div class="table-responsive">
				<?=

				GridView::widget([
					'layout'			 => '{summary}{pager}{items}{pager}',
					'dataProvider'		 => $dataProvider,
					'pager'				 => [
						'class'			 => yii\widgets\LinkPager::className(),
						'firstPageLabel' => 'First',
						'lastPageLabel'	 => 'Last',
					],
					'filterModel'		 => $searchModel,
					'tableOptions'		 => ['class' => 'table table-striped table-bordered table-hover'],
					'headerRowOptions'	 => ['class' => 'x'],
					'columns'			 => [
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
							return Html::a($model->name, ['view', 'id' => $model->id]);
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
					],
				]);

				?>
			</div>

		</div>

	</div>

	<?php \yii\widgets\Pjax::end() ?>


</div>
