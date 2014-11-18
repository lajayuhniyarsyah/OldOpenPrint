<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_preparation_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $preparation_id
 * @property integer $product_uom
 * @property string $product_qty
 * @property integer $product_packaging
 * @property integer $product_id
 * @property string $name
 * @property string $no_moved0
 * @property integer $no
 * @property string $detail
 * @property integer $prodlot_id
 * @property integer $move_id
 *
 * @property StockMove $move
 * @property StockProductionLot $prodlot
 * @property ProductPackaging $productPackaging
 * @property ProductUom $productUom
 * @property OrderPreparation $preparation
 * @property ProductProduct $product
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property DeliveryNoteLine[] $deliveryNoteLines
 * @property OrderPreparationBatch[] $orderPreparationBatches
 */
class OrderPreparationLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_preparation_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'preparation_id', 'product_uom', 'product_packaging', 'product_id', 'no', 'prodlot_id', 'move_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['preparation_id'], 'required'],
            [['product_qty'], 'number'],
            [['name', 'detail'], 'string'],
            [['no_moved0'], 'string', 'max' => 3]
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
            'preparation_id' => 'Order Preparation',
            'product_uom' => 'UoM',
            'product_qty' => 'Quantity',
            'product_packaging' => 'Packaging',
            'product_id' => 'Product',
            'name' => 'Name',
            'no_moved0' => 'No',
            'no' => 'No',
            'detail' => 'Detail Product',
            'prodlot_id' => 'Serial Number',
            'move_id' => 'Move',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMove()
    {
        return $this->hasOne(StockMove::className(), ['id' => 'move_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdlot()
    {
        return $this->hasOne(StockProductionLot::className(), ['id' => 'prodlot_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPackaging()
    {
        return $this->hasOne(ProductPackaging::className(), ['id' => 'product_packaging']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUom()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'product_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPreparation()
    {
        return $this->hasOne(OrderPreparation::className(), ['id' => 'preparation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(ProductProduct::className(), ['id' => 'product_id']);
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
    public function getDeliveryNoteLines()
    {
        return $this->hasMany(DeliveryNoteLine::className(), ['op_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationBatches()
    {
        return $this->hasMany(OrderPreparationBatch::className(), ['batch_id' => 'id']);
    }
}
