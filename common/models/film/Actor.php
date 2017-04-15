<?php

namespace common\models\film;

use Yii;

/**
 * This is the model class for table "actor".
 *
 * @property integer $actor_id
 * @property string $first_name
 * @property string $last_name
 * @property string $last_update
 *
 * @property FilmActor[] $filmActors
 * @property Film[] $films
 */
class Actor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['last_update'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'actor_id' => 'Actor ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilmActors()
    {
        return $this->hasMany(FilmActor::className(), ['actor_id' => 'actor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilms()
    {
        return $this->hasMany(Film::className(), ['film_id' => 'film_id'])->viaTable('film_actor', ['actor_id' => 'actor_id']);
    }
    public function findByName($f_name, $l_name)
    {
        $query = $this->find()->all()->where(['first_name' => $f_name])->andWhere(['last_name' => $l_name]);
        return $query[0];
    }
}
