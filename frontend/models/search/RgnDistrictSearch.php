<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RgnDistrict;

/**
 * RgnDistrict represents the model behind the search form about `common\models\RgnDistrict`.
 */
class RgnDistrictSearch extends RgnDistrict
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'city_id'], 'integer'],
			[['created_at', 'updated_at', 'deleted_at', 'createdBy_id', 'updatedBy_id', 'deletedBy_id'], 'integer'],
			[['status', 'number', 'name'], 'safe'],
		];

	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();

	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = RgnDistrict::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);

		if (!$this->validate())
		{
			// uncomment the following line if you do not want to any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
			'id'			 => $this->id,
			'city_id'		 => $this->city_id,
			'created_at'	 => $this->created_at,
			'updated_at'	 => $this->updated_at,
			'deleted_at'	 => $this->deleted_at,
			'createdBy_id'	 => $this->createdBy_id,
			'updatedBy_id'	 => $this->updatedBy_id,
			'deletedBy_id'	 => $this->deletedBy_id,
		]);

		$query
			->andFilterWhere(['like', 'status', $this->status])
			->andFilterWhere(['like', 'number', '%' . $this->number, FALSE])
			->andFilterWhere(['like', 'name', $this->name]);

		return $dataProvider;

	}

	/**
	 * Creates data provider instance for active District with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function searchActive($params)
	{
		$scope = $this->formName();
		$params[$scope]['status'] = RgnDistrict::STATUS_ACTIVE;

		return $this->search($params);

	}

	/**
	 * Creates data provider instance for deleted District with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function searchDeleted($params)
	{
		$scope = $this->formName();
		$params[$scope]['status'] = RgnDistrict::STATUS_DELETED;

		return $this->search($params);

	}

}
