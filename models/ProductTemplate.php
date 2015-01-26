<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_template".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property double $warranty
 * @property integer $uos_id
 * @property string $list_price
 * @property string $description
 * @property string $weight
 * @property string $weight_net
 * @property string $standard_price
 * @property string $mes_type
 * @property integer $uom_id
 * @property string $description_purchase
 * @property string $cost_method
 * @property integer $categ_id
 * @property string $name
 * @property string $uos_coeff
 * @property double $volume
 * @property boolean $sale_ok
 * @property string $description_sale
 * @property integer $product_manager
 * @property integer $company_id
 * @property string $state
 * @property double $produce_delay
 * @property integer $uom_po_id
 * @property boolean $rental
 * @property string $type
 * @property string $loc_rack
 * @property string $loc_row
 * @property double $sale_delay
 * @property string $loc_case
 * @property string $supply_method
 * @property string $procure_method
 * @property boolean $purchase_ok
 *
 * @property ProductSupplierinfo[] $productSupplierinfos
 * @property ProductProduct[] $productProducts
 * @property ProductCategory $categ
 * @property ProductUom $uomPo
 * @property ResUsers $productManager
 * @property ProductUom $uos
 * @property ResCompany $company
 * @property ProductUom $uom
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property ProductPricelistItem[] $productPricelistItems
 * @property ProductTaxesRel[] $productTaxesRels
 * @property ProductSupplierTaxesRel[] $productSupplierTaxesRels
 */
class ProductTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'uos_id', 'uom_id', 'categ_id', 'product_manager', 'company_id', 'uom_po_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['warranty', 'list_price', 'weight', 'weight_net', 'standard_price', 'uos_coeff', 'volume', 'produce_delay', 'sale_delay'], 'number'],
            [['description', 'mes_type', 'description_purchase', 'cost_method', 'description_sale', 'state', 'type', 'supply_method', 'procure_method'], 'string'],
            [['uom_id', 'cost_method', 'categ_id', 'name', 'uom_po_id', 'type', 'supply_method', 'procure_method'], 'required'],
            [['sale_ok', 'rental', 'purchase_ok'], 'boolean'],
            [['name'], 'string', 'max' => 128],
            [['loc_rack', 'loc_row', 'loc_case'], 'string', 'max' => 16]
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
            'warranty' => 'Warranty',
            'uos_id' => 'Unit of Sale',
            'list_price' => 'Sale Price',
            'description' => 'Description',
            'weight' => 'Gross Weight',
            'weight_net' => 'Net Weight',
            'standard_price' => 'Cost',
            'mes_type' => 'Measure Type',
            'uom_id' => 'Unit of Measure',
            'description_purchase' => 'Purchase Description',
            'cost_method' => 'Costing Method',
            'categ_id' => 'Category',
            'name' => 'Name',
            'uos_coeff' => 'Unit of Measure -> UOS Coeff',
            'volume' => 'Volume',
            'sale_ok' => 'Can be Sold',
            'description_sale' => 'Sale Description',
            'product_manager' => 'Product Manager',
            'company_id' => 'Company',
            'state' => 'Status',
            'produce_delay' => 'Manufacturing Lead Time',
            'uom_po_id' => 'Purchase Unit of Measure',
            'rental' => 'Can be Rent',
            'type' => 'Product Type',
            'loc_rack' => 'Rack',
            'loc_row' => 'Row',
            'sale_delay' => 'Customer Lead Time',
            'loc_case' => 'Case',
            'supply_method' => 'Supply Method',
            'procure_method' => 'Procurement Method',
            'purchase_ok' => 'Can be Purchased',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplierinfos()
    {
        return $this->hasMany(ProductSupplierinfo::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductProducts()
    {
        return $this->hasMany(ProductProduct::className(), ['product_tmpl_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCateg()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'categ_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUomPo()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'uom_po_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductManager()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'product_manager']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUos()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'uos_id']);
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
    public function getProductPricelistItems()
    {
        return $this->hasMany(ProductPricelistItem::className(), ['product_tmpl_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTaxesRels()
    {
        return $this->hasMany(ProductTaxesRel::className(), ['prod_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductSupplierTaxesRels()
    {
        return $this->hasMany(ProductSupplierTaxesRel::className(), ['prod_id' => 'id']);
    }
}
