<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use frontend\models\RgnCountry;
use frontend\models\access\RgnCountryAccess;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\search\RgnCountrySearch $searchModel
 */
$this->title = 'Deleted Region Countries';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="giiant-crud rgn-country-deleted">

	<?php //     echo $this->render('_search', ['model' =>$searchModel]);	?>

    <div class="clearfix">

        <p class="pull-left">
			<?= RgnCountryAccess::button('create'); ?>
		</p>

        <div class="pull-right">
			<?= RgnCountryAccess::button('index'); ?>
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
						[
							'class' => 'yii\grid\SerialColumn',
						],
						[
							"attribute"	 => "name",
							"format"	 => "raw",
							"options"	 => [],
							"value"		 => function(RgnCountry $model)
						{
							return $model->operation->linkView;
						}
						],
						'abbreviation',
						[
							"label"		 => 'Action',
							"class"		 => \yii\grid\DataColumn::className(),
							"options"	 => [
								"width" => "120px",
							],
							"format"	 => "raw",
							"value"		 => function(RgnCountry $model)
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
