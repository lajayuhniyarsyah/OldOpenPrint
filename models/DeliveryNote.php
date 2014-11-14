<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery_note".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $colorcode
 * @property integer $partner_id
 * @property string $poc
 * @property string $name
 * @property integer $partner_shipping_id
 * @property string $note
 * @property string $state
 * @property string $tanggal
 * @property integer $prepare_id
 * @property string $ekspedisi
 * @property string $jumlah_coli
 * @property string $terms
 * @property boolean $special
 * @property integer $work_order_id
 * @property integer $work_order_in
 *
 * @property PackingListLine[] $packingListLines
 * @property StockPicking[] $stockPickings
 * @property DeliveryNoteLine[] $deliveryNoteLines
 * @property PerintahKerjaInternal $workOrderIn
 * @property PerintahKerja $workOrder
 * @property OrderPreparation $prepare
 * @property ResPartner $partnerShipping
 * @property ResPartner $partner
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class DeliveryNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'partner_id', 'partner_shipping_id', 'prepare_id', 'work_order_id', 'work_order_in'], 'integer'],
            [['create_date', 'write_date', 'tanggal'], 'safe'],
            [['name'], 'required'],
            [['note', 'state', 'terms'], 'string'],
            [['special'], 'boolean'],
            [['colorcode', 'poc', 'name', 'jumlah_coli'], 'string', 'max' => 64],
            [['ekspedisi'], 'string', 'max' => 128]
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
            'colorcode' => 'Color/Stock Code',
            'partner_id' => 'Customer',
            'poc' => 'Customer Reference',
            'name' => 'Delivery Note',
            'partner_shipping_id' => 'Delivery Address',
            'note' => 'Notes',
            'state' => 'State',
            'tanggal' => 'Date',
            'prepare_id' => 'Order Packaging',
            'ekspedisi' => 'Ekspedisi',
            'jumlah_coli' => 'Jumlah Coli',
            'terms' => 'Terms & Condition',
            'special' => 'Special WO',
            'work_order_id' => 'SPK',
            'work_order_in' => 'SPK Internal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPackingListLines()
    {
        return $this->hasMany(PackingListLine::className(), ['note_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['note_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLines()
    {
        return $this->hasMany(DeliveryNoteLine::className(), ['note_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrderIn()
    {
        return $this->hasOne(PerintahKerjaInternal::className(), ['id' => 'work_order_in']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkOrder()
    {
        return $this->hasOne(PerintahKerja::className(), ['id' => 'work_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrepare()
    {
        return $this->hasOne(OrderPreparation::className(), ['id' => 'prepare_id']);
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
}
