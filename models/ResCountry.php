<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "res_country".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $address_format
 * @property integer $currency_id
 * @property string $code
 * @property string $name
 *
 * @property ResCountryState[] $resCountryStates
 * @property ResCurrency $currency
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ResBank[] $resBanks
 * @property ResPartnerBank[] $resPartnerBanks
 * @property ResPartner[] $resPartners
 * @property HrEmployee[] $hrEmployees
 * @property DeliveryGridCountryRel[] $deliveryGridCountryRels
 */
class ResCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'currency_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['address_format'], 'string'],
            [['name'], 'required'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 64],
            [['code'], 'unique'],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'address_format' => 'Address Format',
            'currency_id' => 'Currency',
            'code' => 'Country Code',
            'name' => 'Country Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCountryStates()
    {
        return $this->hasMany(ResCountryState::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(ResCurrency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWriteU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'write_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResBanks()
    {
        return $this->hasMany(ResBank::className(), ['country' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartnerBanks()
    {
        return $this->hasMany(ResPartnerBank::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResPartners()
    {
        return $this->hasMany(ResPartner::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrEmployees()
    {
        return $this->hasMany(HrEmployee::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryGridCountryRels()
    {
        return $this->hasMany(DeliveryGridCountryRel::className(), ['country_id' => 'id']);
    }
}
