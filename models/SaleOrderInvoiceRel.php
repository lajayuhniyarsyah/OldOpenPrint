<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_order_invoice_rel".
 *
 * @property integer $order_id
 * @property integer $invoice_id
 *
 * @property AccountInvoice $invoice
 * @property SaleOrder $order
 */
class SaleOrderInvoiceRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_order_invoice_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'invoice_id'], 'required'],
            [['order_id', 'invoice_id'], 'integer'],
            [['order_id', 'invoice_id'], 'unique', 'targetAttribute' => ['order_id', 'invoice_id'], 'message' => 'The combination of Order ID and Invoice ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'invoice_id' => 'Invoice ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(AccountInvoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(SaleOrder::className(), ['id' => 'order_id']);
    }
}
