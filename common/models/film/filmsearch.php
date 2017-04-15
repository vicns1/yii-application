<?php

namespace common\models\film;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\film\film;

/**
 * filmsearch represents the model behind the search form about `common\models\film\film`.
 */
class filmsearch extends film
{
    public $category;
    public $language;
/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['film_id', 'language_id', 'original_language_id', 'rental_duration', 'length', 'category_id'], 'integer'],
            [['title', 'description', 'release_year', 'rating', 'special_features', 'last_update', 'language', 'category'], 'safe'],
            [['rental_rate', 'replacement_cost'], 'number'],
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
        $query = film::find();
        $query->joinWith('category','language');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['language'] =[
         'asc' =>  ['language.name'=>SORT_ASC],
         'desc' => ['language.name'=>SORT_DESC],]; 
        $dataProvider->sort->attributes['category'] =[
          'asc' =>  ['category.name'=>SORT_ASC],
          'desc' => ['category.name'=>SORT_DESC],];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'film_id' => $this->film_id,
            'release_year' => $this->release_year,
            'language_id' => $this->language_id,
            'original_language_id' => $this->original_language_id,
            'rental_duration' => $this->rental_duration,
            'rental_rate' => $this->rental_rate,
            'length' => $this->length,
            'replacement_cost' => $this->replacement_cost,
            'last_update' => $this->last_update,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'rating', $this->rating])
            ->andFilterWhere(['like', 'special_features', $this->special_features]);

        return $dataProvider;
    }
}
