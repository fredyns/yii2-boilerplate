<?php

namespace frontend\modules\region\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\region\models\Postcode;

/**
 * PostcodeSearch represents the model behind the search form about `frontend\modules\region\models\Postcode`.
 */
class PostcodeSearch extends Postcode
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'postcode', 'subdistrict_id', 'district_id', 'city_id', 'province_id', 'country_id'], 'integer'],
			[['recordStatus'], 'safe'],
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
		$query = Postcode::find();

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
			'postcode'		 => $this->postcode,
			'subdistrict_id' => $this->subdistrict_id,
			'district_id'	 => $this->district_id,
			'city_id'		 => $this->city_id,
			'province_id'	 => $this->province_id,
			'country_id'	 => $this->country_id,
		]);

		$query->andFilterWhere(['like', 'recordStatus', $this->recordStatus]);

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
