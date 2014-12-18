<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_payment_term".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property boolean $active
 * @property string $note
 * @property string $name
 *
 * @property AccountPaymentTermLine[] $accountPaymentTermLines
 * @property AccountInvoice[] $accountInvoices
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property PurchaseOrder[] $purchaseOrders
 * @property SaleShop[] $saleShops
 * @property SaleOrder[] $saleOrders
 */
class AccountPaymentTerm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_payment_term';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['active'], 'boolean'],
            [['note'], 'string'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64]
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
            'active' => 'Active',
            'note' => 'Description',
            'name' => 'Payment Term',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPaymentTermLines()
    {
        return $this->hasMany(AccountPaymentTermLine::className(), ['payment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoices()
    {
        return $this->hasMany(AccountInvoice::className(), ['payment_term' => 'id']);
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
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['payment_term_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleShops()
    {
        return $this->hasMany(SaleShop::className(), ['payment_default_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrders()
    {
        return $this->hasMany(SaleOrder::className(), ['payment_term' => 'id']);
    }
}
