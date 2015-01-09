<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internal_move_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $uom_id
 * @property string $desc
 * @property integer $product_id
 * @property integer $internal_move_request_line_id
 * @property integer $line_request_id
 * @property double $qty
 * @property integer $internal_move_id
 * @property integer $no
 * @property integer $stock_move_id
 * @property string $name
 *
 * @property StockMove $stockMove
 * @property InternalMove $internalMove
 * @property InternalMoveRequestLine $lineRequest
 * @property ProductProduct $product
 * @property InternalMoveRequestLine $internalMoveRequestLine
 * @property ProductUom $uom
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property InternalMoveLineDetail[] $internalMoveLineDetails
 */
class InternalMoveLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'internal_move_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'uom_id', 'product_id', 'internal_move_request_line_id', 'line_request_id', 'internal_move_id', 'no', 'stock_move_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['uom_id', 'product_id', 'qty', 'internal_move_id'], 'required'],
            [['desc', 'name'], 'string'],
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
            'uom_id' => 'UOM',
            'desc' => 'Description',
            'product_id' => 'Product',
            'internal_move_request_line_id' => 'IM Req Line',
            'line_request_id' => 'Line Related',
            'qty' => 'Qty',
            'internal_move_id' => 'Internal Move No',
            'no' => 'No',
            'stock_move_id' => 'Move',
            'name' => 'Name',
        ];
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
    public function getInternalMove()
    {
        return $this->hasOne(InternalMove::className(), ['id' => 'internal_move_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineRequest()
    {
        return $this->hasOne(InternalMoveRequestLine::className(), ['id' => 'line_request_id']);
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
    public function getInternalMoveRequestLine()
    {
        return $this->hasOne(InternalMoveRequestLine::className(), ['id' => 'internal_move_request_line_id']);
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
    public function getInternalMoveLineDetails()
    {
        return $this->hasMany(InternalMoveLineDetail::className(), ['internal_move_line_id' => 'id']);
    }
}
