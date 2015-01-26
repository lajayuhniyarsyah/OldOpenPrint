<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "move_set_data".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $product_id
 * @property integer $product_uom
 * @property integer $no
 * @property integer $location_id
 * @property integer $origin_move_id
 * @property double $product_qty
 * @property integer $location_dest_id
 * @property string $type
 * @property integer $picking_id
 * @property string $desc
 *
 * @property StockLocation $location
 * @property StockLocation $locationDest
 * @property ProductProduct $product
 * @property StockPicking $picking
 * @property ProductUom $productUom
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class MoveSetData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'move_set_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'product_id', 'product_uom', 'no', 'location_id', 'origin_move_id', 'location_dest_id', 'picking_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['product_id', 'product_qty'], 'required'],
            [['product_qty'], 'number'],
            [['type', 'desc'], 'string']
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
            'product_id' => 'Product',
            'product_uom' => 'UOM',
            'no' => 'No',
            'location_id' => 'Source Location',
            'origin_move_id' => 'Origin Move ID',
            'product_qty' => 'Quantity',
            'location_dest_id' => 'Destination Location',
            'type' => 'type',
            'picking_id' => 'Picking',
            'desc' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationDest()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'location_dest_id']);
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
    public function getPicking()
    {
        return $this->hasOne(StockPicking::className(), ['id' => 'picking_id']);
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
