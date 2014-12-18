<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_payment_term_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $payment_id
 * @property integer $days2
 * @property string $value
 * @property string $value_amount
 * @property integer $days
 *
 * @property ResUsers $writeU
 * @property AccountPaymentTerm $payment
 * @property ResUsers $createU
 */
class AccountPaymentTermLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_payment_term_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'payment_id', 'days2', 'days'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['payment_id', 'days2', 'value', 'days'], 'required'],
            [['value'], 'string'],
            [['value_amount'], 'number']
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
            'payment_id' => 'Payment Term',
            'days2' => 'Day of the Month',
            'value' => 'Computation',
            'value_amount' => 'Amount To Pay',
            'days' => 'Number of Days',
        ];
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
    public function getPayment()
    {
        return $this->hasOne(AccountPaymentTerm::className(), ['id' => 'payment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
    }
}
