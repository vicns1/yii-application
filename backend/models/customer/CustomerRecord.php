<?php
/**
 * Created by PhpStorm.
 * User: Hijarian
 * Date: 04.07.14
 * Time: 11:51
 */

namespace backend\models\customer;

use yii\db\ActiveRecord;

class CustomerRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'customer';
    }

    public function rules()
    {
        return [
            ['customer_id', 'number'],
            [['first_name','create_date'], 'required'],
            [['first_name', 'last_name', 'email'], 'string', 'max' => 256],
            ['create_date', 'date',  'format' => 'yyyy-mm-dd'],
            ['last_name', 'safe']
        ];
    }
/*
    public function behaviors()
    {
        return [
            'timestamp' => \yii\behaviors\TimestampBehavior::className(),
            'blame' => \yii\behaviors\BlameableBehavior::className()
        ];
    }
*/
    public function getPhones()
    {
        return $this->hasMany(PhoneRecord::className(), ['customer_id' => 'customer_id']);
    }

    public function getAddresses()
    {
        return $this->hasMany(AddressRecord::className(), ['customer_id' => 'customer_id']);
    }
}
