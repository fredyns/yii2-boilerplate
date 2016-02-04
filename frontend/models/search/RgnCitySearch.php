<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RgnCity;

/**
 * RgnCitySearch represents the model behind the search form about `frontend\models\RgnCity`.
 */
class RgnCitySearch extends RgnCity
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id'], 'integer'],
			[['recordStatus', 'number', 'name', 'abbreviation', 'province_id'], 'safe'],
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
		$query = RgnCity::find()->with('province');

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
			'rgn_city.id' => $this->id,
		]);

		$query
			->andFilterWhere(['like', 'rgn_city.recordStatus', $this->recordStatus])
			->andFilterWhere(['like', 'rgn_city.number', $this->number])
			->andFilterWhere(['like', 'rgn_city.name', $this->name])
			->andFilterWhere(['like', 'rgn_city.abbreviation', $this->abbreviation]);

		if (is_integer($this->province_id))
		{
			$query->andFilterWhere([
				'province_id' => $this->province_id,
			]);
		}
		else if ($this->province_id)
		{
			$query->joinWith([
				'province' => function ($q)
				{
					$q->where('rgn_province.name LIKE "%' . $this->province_id . '%"');
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
		$params[$this->formName()]['recordStatus'] = static::RECORDSTATUS_USED;

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
		$params[$this->formName()]['recordStatus'] = static::RECORDSTATUS_DELETED;

		return $this->search($params);

	}

}
