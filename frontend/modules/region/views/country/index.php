<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use frontend\modules\region\models\Country;
use frontend\modules\region\models\access\CountryAccess;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\modules\region\models\search\CountrySearch $searchModel
 */
$this->title = 'Countries';
$this->params['breadcrumbs'][] = ['label' => 'Region', 'url' => ['/region']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="giiant-crud country-index">

	<?php //     echo $this->render('_search', ['model' =>$searchModel]);   ?>

    <div class="clearfix">

        <p class="pull-left">
			<?= CountryAccess::button('create'); ?>
		</p>

        <div class="pull-right">
			<?= CountryAccess::button('deleted'); ?>
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
							'class'		 => 'yii\grid\SerialColumn',
							"options"	 => [
								"width" => "50px",
							],
						],
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
						[
							"label"		 => 'Action',
							"class"		 => \yii\grid\DataColumn::className(),
							"options"	 => [
								"width" => "120px",
							],
							"format"	 => "raw",
							"value"		 => function(Country $model)
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
