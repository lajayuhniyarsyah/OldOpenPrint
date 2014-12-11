<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_preparation".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property integer $partner_shipping_id
 * @property integer $sale_id
 * @property string $duedate
 * @property string $note
 * @property string $state
 * @property string $tanggal
 * @property integer $picking_id
 * @property integer $partner_id
 * @property string $poc
 * @property string $terms
 *
 * @property OrderPreparationLine[] $orderPreparationLines
 * @property SaleOrder $sale
 * @property ResPartner $partnerShipping
 * @property StockPicking $picking
 * @property ResPartner $partner
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property DeliveryNote[] $deliveryNotes
 * @property ProductBatchLine[] $productBatchLines
 */
class OrderPreparation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_preparation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'partner_shipping_id', 'sale_id', 'picking_id', 'partner_id'], 'integer'],
            [['create_date', 'write_date', 'duedate', 'tanggal'], 'safe'],
            [['name', 'sale_id', 'picking_id'], 'required'],
            [['note', 'state', 'terms'], 'string'],
            [['name', 'poc'], 'string', 'max' => 64]
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
            'name' => 'Reference',
            'partner_shipping_id' => 'Delivery Address',
            'sale_id' => 'Sale Order',
            'duedate' => 'Due Date',
            'note' => 'Notes',
            'state' => 'State',
            'tanggal' => 'Date Preparation',
            'picking_id' => 'Delivery Order',
            'partner_id' => 'Customer',
            'poc' => 'Customer Reference',
            'terms' => 'Terms & Condition',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationLines()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['preparation_id' => 'id'])->orderBy('no ASC');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(SaleOrder::className(), ['id' => 'sale_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnerShipping()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_shipping_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPicking()
    {
        return $this->hasOne(StockPicking::className(), ['id' => 'picking_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_id']);
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
    public function getDeliveryNotes()
    {
        return $this->hasMany(DeliveryNote::className(), ['prepare_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductBatchLines()
    {
        return $this->hasMany(ProductBatchLine::className(), ['preparation_id' => 'id']);
    }
}
