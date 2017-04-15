<?php

namespace backend\models\customer;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\customer\CustomerRecord;

/**
 * CustomerRecordSearch represents the model behind the search form about `app\models\customer\CustomerRecord`.
 */
class CustomerRecordSearch extends CustomerRecord
{

    public $country;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['customer_id', 'integer'],
            [['create_date', 'last_name'], 'safe'],
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
        $query = CustomerRecord::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('addresses');
        $dataProvider->sort->attributes['country'] = [
            'asc' => ['address.country' => SORT_ASC],
            'desc' => ['address.country' => SORT_DESC]
        ];

        $query->joinWith('phones');
        $dataProvider->sort->attributes['phone'] = [
            'asc' => ['phone.number' => SORT_ASC],
            'desc' => ['phone.number' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'customer.id' => $this->customer_id,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name]);

        return $dataProvider;
    }
}
