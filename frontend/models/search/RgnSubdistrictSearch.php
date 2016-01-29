<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RgnSubdistrict;

/**
 * RgnSubdistrictSearch represents the model behind the search form about `frontend\models\RgnSubdistrict`.
 */
class RgnSubdistrictSearch extends RgnSubdistrict
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'district_id'], 'integer'],
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
		$query = RgnSubdistrict::find()->with('district');

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
			'district_id'	 => $this->district_id,
		]);

		$query
			->andFilterWhere(['like', 'status', $this->status])
			->andFilterWhere(['like', 'number', $this->number])
			->andFilterWhere(['like', 'name', $this->name]);

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
