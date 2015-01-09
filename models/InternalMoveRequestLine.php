<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internal_move_request_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $uom_id
 * @property integer $product_id
 * @property integer $internal_move_request_id
 * @property double $qty
 * @property integer $no
 * @property string $desc
 *
 * @property InternalMoveLine[] $internalMoveLines
 * @property InternalMoveRequest $internalMoveRequest
 * @property ProductProduct $product
 * @property ProductUom $uom
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class InternalMoveRequestLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'internal_move_request_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'uom_id', 'product_id', 'internal_move_request_id', 'no'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['uom_id', 'product_id', 'internal_move_request_id', 'qty', 'no'], 'required'],
            [['qty'], 'number'],
            [['desc'], 'string']
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
            'product_id' => 'Product',
            'internal_move_request_id' => 'Move Req',
            'qty' => 'Qty',
            'no' => 'No',
            'desc' => 'Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLines()
    {
        return $this->hasMany(InternalMoveLine::className(), ['internal_move_request_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveRequest()
    {
        return $this->hasOne(InternalMoveRequest::className(), ['id' => 'internal_move_request_id']);
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
}
