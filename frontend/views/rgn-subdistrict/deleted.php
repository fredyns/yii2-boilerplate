<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use frontend\models\access\RgnSubdistrictAccess;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\search\RgnSubdistrictSearch $searchModel
 */
$this->title = 'Rgn Subdistricts';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="giiant-crud rgn-subdistrict-deleted">

	<?php //     echo $this->render('_search', ['model' =>$searchModel]);   ?>

    <div class="clearfix">

        <p class="pull-left">
			<?= RgnDistrictAccess::button('create'); ?>
		</p>

        <div class="pull-right">
			<?= RgnDistrictAccess::button('index'); ?>
		</div>

    </div>


	<?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h2>
				<i><?= $this->title; ?></i>
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
						'number',
						'name',
						[
							'attribute'	 => 'district_id',
							"format"	 => "raw",
							"options"	 => [],
							'value'		 => function ($model)
						{
							if ($district = $model->getDistrict()->one())
							{
								return $district->operation->linkView;
							}

							return '';
						},
						],
						[
							"class"		 => \yii\grid\DataColumn::className(),
							"label"		 => 'Action',
							"options"	 => [
								"width" => "120px",
							],
							"format"	 => "raw",
							"value"		 => function($model)
						{
							return $model->operation->widgetDropdown();
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
