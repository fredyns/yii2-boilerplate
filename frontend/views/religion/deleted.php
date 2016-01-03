<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use frontend\models\Religion;
use frontend\models\access\ReligionAccess;
use common\widgets\Moderation;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var frontend\models\search\ReligionSearch $searchModel
 */
$this->title = 'Deleted Religions';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="giiant-crud religion-deleted">

	<?php //     echo $this->render('_search', ['model' =>$searchModel]);   ?>

    <div class="clearfix">
        <p class="pull-left">

			<?= ReligionAccess::button('create'); ?>
        </p>

        <div class="pull-right">

			<?= ReligionAccess::button('index'); ?>

		</div>
    </div>


	<?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

	<div class="panel panel-default">
		<div class="panel-heading" style="z">
			<h2>
				<i><?= 'Religions' ?></i>
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
						'lastPageLabel'	 => 'Last'],
					'filterModel'		 => $searchModel,
					'tableOptions'		 => ['class' => 'table table-striped table-bordered table-hover'],
					'headerRowOptions'	 => ['class' => 'x'],
					'columns'			 => [

						[
							'class'		 => 'yii\grid\ActionColumn',
							'urlCreator' => function($action, $model, $key, $index)
							{
								// using the column name as key, not mapping to 'id' like the standard generator

								$params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
								$params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;

								return Url::toRoute($params);
							},
								'contentOptions' => ['nowrap' => 'nowrap']
							],
							[
								"attribute"	 => "statusLabel",
								"options"	 => [],
								"value"		 => function(Religion $model)
							{
								return $model->statusLabel;
							}
							],
							[
								"attribute"	 => "name",
								"format"	 => "raw",
								"options"	 => [],
								"value"		 => function(Religion $model)
							{
								return $model->operation->linkView
									. "<br/>"
									. "<div style=\"font-size: 0.8em;\">"
									. " &centerdot; "
									. $model->operation->widgetLink(['update', 'restore'])
									. " &centerdot; "
									. "</div>";
							}
							],
							[
								"label"		 => 'Action',
								"class"		 => \yii\grid\DataColumn::className(),
								"options"	 => [
									"width" => "120px",
								],
								"format"	 => "raw",
								"value"		 => function(Religion $model)
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
