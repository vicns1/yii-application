<?php

namespace common\models\film;

use Yii;

/**
 * This is the model class for table "film".
 *
 * @property integer $film_id
 * @property string $title
 * @property string $description
 * @property string $release_year
 * @property integer $language_id
 * @property integer $original_language_id
 * @property integer $rental_duration
 * @property string $rental_rate
 * @property integer $length
 * @property string $replacement_cost
 * @property string $rating
 * @property string $special_features
 * @property string $last_update
 * @property integer $category_id
 *
 * @property Language $language
 * @property Language $originalLanguage
 * @property FilmActor[] $filmActors
 * @property Actor[] $actors
 * @property FilmCategory[] $filmCategories
 * @property Category[] $categories
 * @property Inventory[] $inventories
 */
class Film extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'film';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description', 'rating', 'special_features'], 'string'],
            [['release_year', 'last_update', 'hmlength'], 'safe'],
            [['language_id', 'original_language_id', 'rental_duration', 'length', 'category_id'], 'integer'],
            [['rental_rate', 'replacement_cost'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'language_id']],
            [['original_language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['original_language_id' => 'language_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'film_id' => 'Film ID',
            'title' => 'Title',
            'description' => 'Description',
            'release_year' => 'Release Year',
            'language_id' => 'Language',
            'original_language_id' => 'Original Language',
            'rental_duration' => 'Rental Duration',
            'rental_rate' => 'Rental Rate',
            'length' => 'Length',
            'hmlength' => 'Length',
            'replacement_cost' => 'Replacement Cost',
            'rating' => 'Rating',
            'special_features' => 'Special Features',
            'last_update' => 'Last Update',
            'category_id' => 'Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['language_id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOriginalLanguage()
    {
        return $this->hasOne(Language::className(), ['language_id' => 'original_language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmActors()
    {
        return $this->hasMany(FilmActor::className(), ['film_id' => 'film_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActors()
    {
        return $this->hasMany(Actor::className(), ['actor_id' => 'actor_id'])->viaTable('film_actor', ['film_id' => 'film_id']);
    }
 
    public function getActor($actor_id)
    {
        return $this->hasMany(Actor::className(), ['actor_id' => $actor_id ])->viaTable('film_actor', ['film_id' => 'film_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmCategories()
    {
        return $this->hasMany(FilmCategory::className(), ['film_id' => 'film_id']);
    }
   public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['category_id' => 'category_id'])->viaTable('film_category', ['film_id' => 'film_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventories()
    {
        return $this->hasMany(Inventory::className(), ['film_id' => 'film_id']);
    }
    public function sethmLength($hmlength)
    {
        list($hour, $min) = sscanf($hmlength, '%2d:%02d');
        $hour = ($hour)?$hour:0;
        $this->length = $hour*60 + $min;
    }
    public function gethmLength()
    {
        $hour = floor($this->length/60);
        $min = $this->length%60;
        return  sprintf('%2d:%02d', $hour, $min);
    }
}
