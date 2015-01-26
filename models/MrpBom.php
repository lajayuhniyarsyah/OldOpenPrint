<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mrp_bom".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $date_stop
 * @property string $code
 * @property integer $product_uom
 * @property double $product_uos_qty
 * @property string $date_start
 * @property string $product_qty
 * @property integer $product_uos
 * @property double $product_efficiency
 * @property boolean $active
 * @property double $product_rounding
 * @property string $name
 * @property integer $sequence
 * @property integer $company_id
 * @property integer $routing_id
 * @property integer $product_id
 * @property integer $bom_id
 * @property string $position
 * @property string $type
 *
 * @property MrpBomPropertyRel[] $mrpBomPropertyRels
 * @property MrpRouting $routing
 * @property ResCompany $company
 * @property MrpBom $bom
 * @property MrpBom[] $mrpBoms
 * @property ProductUom $productUos
 * @property ProductProduct $product
 * @property ProductUom $productUom
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ProcurementOrder[] $procurementOrders
 * @property MrpProduction[] $mrpProductions
 */
class MrpBom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mrp_bom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'product_uom', 'product_uos', 'sequence', 'company_id', 'routing_id', 'product_id', 'bom_id'], 'integer'],
            [['create_date', 'write_date', 'date_stop', 'date_start'], 'safe'],
            [['product_uom', 'product_qty', 'product_efficiency', 'company_id', 'product_id', 'type'], 'required'],
            [['product_uos_qty', 'product_qty', 'product_efficiency', 'product_rounding'], 'number'],
            [['active'], 'boolean'],
            [['type'], 'string'],
            [['code'], 'string', 'max' => 16],
            [['name', 'position'], 'string', 'max' => 64]
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
            'date_stop' => 'Valid Until',
            'code' => 'Reference',
            'product_uom' => 'Product Unit of Measure',
            'product_uos_qty' => 'Product UOS Qty',
            'date_start' => 'Valid From',
            'product_qty' => 'Product Quantity',
            'product_uos' => 'Product UOS',
            'product_efficiency' => 'Manufacturing Efficiency',
            'active' => 'Active',
            'product_rounding' => 'Product Rounding',
            'name' => 'Name',
            'sequence' => 'Sequence',
            'company_id' => 'Company',
            'routing_id' => 'Routing',
            'product_id' => 'Product',
            'bom_id' => 'Parent BoM',
            'position' => 'Internal Reference',
            'type' => 'BoM Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpBomPropertyRels()
    {
        return $this->hasMany(MrpBomPropertyRel::className(), ['bom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRouting()
    {
        return $this->hasOne(MrpRouting::className(), ['id' => 'routing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBom()
    {
        return $this->hasOne(MrpBom::className(), ['id' => 'bom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpBoms()
    {
        return $this->hasMany(MrpBom::className(), ['bom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductUos()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'product_uos']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders()
    {
        return $this->hasMany(ProcurementOrder::className(), ['bom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['bom_id' => 'id']);
    }
}
