<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_list_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $product_uom
 * @property integer $packing_id
 * @property integer $product_id
 * @property string $name
 * @property string $product_qty
 * @property string $no
 * @property string $measurement
 * @property string $weight
 *
 * @property ResUsers $writeU
 * @property ProductUom $productUom
 * @property ProductProduct $product
 * @property PackingListLine $packing
 * @property ResUsers $createU
 */
class ProductListLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_list_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'product_uom', 'packing_id', 'product_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['packing_id'], 'required'],
            [['name'], 'string'],
            [['product_qty'], 'number'],
            [['no'], 'string', 'max' => 3],
            [['measurement', 'weight'], 'string', 'max' => 128]
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
            'product_uom' => 'UoM',
            'packing_id' => 'Packing List',
            'product_id' => 'Product',
            'name' => 'Description',
            'product_qty' => 'Quantity',
            'no' => 'No',
            'measurement' => 'measurement',
            'weight' => 'weight',
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
    public function getProductUom()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'product_uom']);
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
    public function getPacking()
    {
        return $this->hasOne(PackingListLine::className(), ['id' => 'packing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
    }
}
