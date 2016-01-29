<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RgnDistrict;

/**
 * RgnDistrictSearch represents the model behind the search form about `frontend\models\RgnDistrict`.
 */
class RgnDistrictSearch extends RgnDistrict
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['status', 'number', 'name', 'city_id'], 'safe'],
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
		$query = RgnDistrict::find()->with('city');

		$dataProvider = new ActiveDataProvider([
			'query'		 => $query,
			'pagination' => [
				'pageSize' => 50,
			],
		]);

		$this->load($params);

		if (!$this->validate())
		{
			// uncomment the following line if you do not want to any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
			'rgn_district.id' => $this->id,
		]);

		$query
			->andFilterWhere(['like', 'rgn_district.status', $this->status])
			->andFilterWhere(['like', 'rgn_district.number', $this->number])
			->andFilterWhere(['like', 'rgn_district.name', $this->name]);

		if (is_integer($this->city_id))
		{
			$query->andFilterWhere([
				'city_id' => $this->city_id,
			]);
		}
		else if ($this->city_id)
		{
			$query->joinWith([
				'city' => function ($q)
				{
					$q->where('rgn_city.name LIKE "%' . $this->city_id . '%"');
				}
			]);
		}

		return $dataProvider;

	}

	/**
	 * Creates data provider instance with search query applied for active model
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function searchIndex($params)
	{
		$params[$this->formName()]['status'] = static::STATUS_ACTIVE;

		return $this->search($params);

	}

	/**
	 * Creates data provider instance with search query applied for deleted model
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function searchDeleted($params)
	{
		$params[$this->formName()]['status'] = static::STATUS_DELETED;

		return $this->search($params);

	}

}
