<?php

namespace backend\models\customer;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\customer\Address;

/**
 * searchAddress represents the model behind the search form about `backend\models\customer\Address`.
 */
class searchAddress extends Address
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address_id', 'country_id'], 'integer'],
            [['address', 'city', 'district', 'postal_code', 'last_update'], 'safe'],
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
        $query = Address::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'address_id' => $this->address_id,
            'last_update' => $this->last_update,
            'country_id' => $this->country_id,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code]);

        return $dataProvider;
    }
}
