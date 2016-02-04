<?php

namespace frontend\modules\region\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\region\models\City;

/**
 * CitySearch represents the model behind the search form about `frontend\modules\region\models\City`.
 */
class CitySearch extends City
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'province_id'], 'integer'],
			[['recordStatus', 'number', 'name', 'abbreviation'], 'safe'],
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
		$query = City::find();

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
			'id'			 => $this->id,
			'province_id'	 => $this->province_id,
		]);

		$query
			->andFilterWhere(['like', 'recordStatus', $this->recordStatus])
			->andFilterWhere(['like', 'number', $this->number])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'abbreviation', $this->abbreviation]);

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
