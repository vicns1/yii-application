<?php

namespace backend\models\customer;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $address_id
 * @property string $address
 * @property string $city
 * @property string $district
 * @property string $postal_code
 * @property string $last_update
 * @property integer $country_id
 *
 * @property Customer[] $customers
 * @property Staff[] $staff
 * @property Store[] $stores
 */
class Address extends \yii\db\ActiveRecord
{
   public $country;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'district', 'country_id'], 'required'],
            [['last_update'], 'safe'],
            [['country_id'], 'integer'],
            [['address', 'city'], 'string', 'max' => 50],
            [['district'], 'string', 'max' => 20],
            [['postal_code'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'address_id' => 'Address ID',
            'address' => 'Address',
            'city' => 'City',
            'district' => 'District',
            'postal_code' => 'Postal Code',
            'last_update' => 'Last Update',
            'country_id' => 'Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['address_id' => 'address_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStores()
    {
        return $this->hasMany(Store::className(), ['address_id' => 'address_id']);
    }
    public function getCountry()
    {
       return $this->hasOne(Country::className(),['country_id'=>'id'])
    }
    public function getFullAddress($id)
    {
        return implode(', ',
            array_filter(
                $this->getAttributes(
                    ['country', 'city', 'district', 'address', 'postal_code'])));   
     }
}

