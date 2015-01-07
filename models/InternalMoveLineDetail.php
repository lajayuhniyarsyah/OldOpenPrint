<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internal_move_line_detail".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $stock_move_id
 * @property integer $product_id
 * @property integer $internal_move_line_id
 * @property integer $uom_id
 * @property string $desc
 * @property integer $stock_prod_lot_id
 * @property string $type
 * @property string $name
 * @property double $qty
 * @property integer $no
 *
 * @property ProductUom $uom
 * @property ProductProduct $product
 * @property StockProductionLot $stockProdLot
 * @property StockMove $stockMove
 * @property InternalMoveLine $internalMoveLine
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class InternalMoveLineDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'internal_move_line_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'stock_move_id', 'product_id', 'internal_move_line_id', 'uom_id', 'stock_prod_lot_id', 'no'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['product_id', 'uom_id', 'type', 'qty'], 'required'],
            [['desc', 'type', 'name'], 'string'],
            [['qty'], 'number']
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
            'stock_move_id' => 'Move',
            'product_id' => 'Product',
            'internal_move_line_id' => 'Internal Move Line No',
            'uom_id' => 'UOM',
            'desc' => 'Description',
            'stock_prod_lot_id' => 'Batch No',
            'type' => 'unknown',
            'name' => 'Name',
            'qty' => 'Qty',
            'no' => 'Line No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUom()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'uom_id']);
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
    public function getStockProdLot()
    {
        return $this->hasOne(StockProductionLot::className(), ['id' => 'stock_prod_lot_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMove()
    {
        return $this->hasOne(StockMove::className(), ['id' => 'stock_move_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLine()
    {
        return $this->hasOne(InternalMoveLine::className(), ['id' => 'internal_move_line_id']);
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
