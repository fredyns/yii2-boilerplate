<?php

namespace frontend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RgnPostcode;

/**
 * RgnPostcodeSearch represents the model behind the search form about `frontend\models\RgnPostcode`.
 */
class RgnPostcodeSearch extends RgnPostcode
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'postcode'], 'integer'],
			[['recordStatus', 'subdistrict_id', 'district_id', 'city_id', 'province_id', 'country_id'], 'safe'],
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
		$query = RgnPostcode::find()->with('province', 'city', 'district');

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
			'rgn_postcode.id'		 => $this->id,
			'rgn_postcode.postcode'	 => $this->postcode,
		]);

		$query->andFilterWhere(['like', 'rgn_postcode.recordStatus', $this->recordStatus]);

		// filtering subdistrict

		if (is_integer($this->subdistrict_id))
		{
			$query->andFilterWhere([
				'subdistrict_id' => $this->subdistrict_id,
			]);
		}
		else if ($this->subdistrict_id)
		{
			$query->joinWith([
				'subdistrict' => function ($q)
				{
					$q->where('rgn_subdistrict.name LIKE "%' . $this->subdistrict_id . '%"');
				}
			]);
		}

		// filtering district

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

		// filtering city

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

		// filtering province

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

		// filtering country

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

	public function filterRelatedField(&$query, $name, $attribute, $searchField)
	{
		if (is_integer($this->district_id))
		{
			$query->andFilterWhere([
				$attribute => $this->$attribute,
			]);
		}
		else if ($this->$attribute)
		{
			$query->joinWith([
				$name => function ($q)
				{
					$q->where($searchField . ' LIKE "%' . $this->$attribute . '%"');
				}
			]);
		}

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
