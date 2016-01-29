<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RgnProvince;

/**
 * RgnProvinceSearch represents the model behind the search form about `frontend\models\RgnProvince`.
 */
class RgnProvinceSearch extends RgnProvince
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['status', 'number', 'name', 'abbreviation', 'country_id'], 'safe'],
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
		$query = RgnProvince::find()->with('country');

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
			'rgn_province.id' => $this->id,
		]);

		$query
			->andFilterWhere(['like', 'rgn_province.status', $this->status])
			->andFilterWhere(['like', 'rgn_province.number', $this->number])
			->andFilterWhere(['like', 'rgn_province.name', $this->name])
			->andFilterWhere(['like', 'rgn_province.abbreviation', $this->abbreviation]);

		if (is_integer($this->country_id))
		{
			$query->andFilterWhere([
				'country_id' => $this->country_id,
			]);
		}
		else if ($this->country_id)
		{
			$query->joinWith([
				'country' => function ($q)
				{
					$q->where('rgn_country.name LIKE "%' . $this->country_id . '%"');
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
