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
			[['id'], 'integer'],
			[['recordStatus', 'number', 'name', 'district_id'], 'safe'],
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
			'rgn_subdistrict.id' => $this->id,
		]);

		$query
			->andFilterWhere(['like', 'rgn_subdistrict.recordStatus', $this->recordStatus])
			->andFilterWhere(['like', 'rgn_subdistrict.number', $this->number])
			->andFilterWhere(['like', 'rgn_subdistrict.name', $this->name]);

		if (is_integer($this->district_id))
		{
			$query->andFilterWhere([
				'district_id' => $this->district_id,
			]);
		}
		else if ($this->district_id)
		{
			$query->joinWith([
				'district' => function ($q)
				{
					$q->where('rgn_district.name LIKE "%' . $this->district_id . '%"');
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
