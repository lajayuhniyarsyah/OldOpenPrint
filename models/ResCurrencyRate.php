<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "res_currency_rate".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $currency_id
 * @property string $rate
 * @property string $name
 * @property integer $currency_rate_type_id
 * @property string $rating
 *
 * @property ResCurrency $currency
 * @property ResCurrencyRateType $currencyRateType
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class ResCurrencyRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_currency_rate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'currency_id', 'currency_rate_type_id'], 'integer'],
            [['create_date', 'write_date', 'name'], 'safe'],
            [['rate', 'rating'], 'number'],
            [['name'], 'required']
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
            'currency_id' => 'Currency ID',
            'rate' => 'Rate',
            'name' => 'Name',
            'currency_rate_type_id' => 'Currency Rate Type ID',
            'rating' => 'Rating',
        ];
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
    public function getCurrencyRateType()
    {
        return $this->hasOne(ResCurrencyRateType::className(), ['id' => 'currency_rate_type_id']);
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
}
