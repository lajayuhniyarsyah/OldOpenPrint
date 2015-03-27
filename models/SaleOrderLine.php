<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_order_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $product_uos_qty
 * @property integer $product_uom
 * @property integer $sequence
 * @property integer $order_id
 * @property string $price_unit
 * @property string $product_uom_qty
 * @property string $discount
 * @property integer $product_uos
 * @property string $name
 * @property integer $company_id
 * @property integer $salesman_id
 * @property string $state
 * @property integer $product_id
 * @property integer $order_partner_id
 * @property double $th_weight
 * @property boolean $invoiced
 * @property string $type
 * @property integer $address_allotment_id
 * @property integer $procurement_id
 * @property double $delay
 * @property integer $product_packaging
 * @property string $product_onhand
 * @property string $product_future
 * @property string $discount_nominal
 *
 * @property SaleOrderLineInvoiceRel[] $saleOrderLineInvoiceRels
 * @property SaleOrderTax[] $saleOrderTaxes
 * @property StockMove[] $stockMoves
 * @property ProductPackaging $productPackaging
 * @property ProcurementOrder $procurement
 * @property ProductUom $productUom
 * @property SaleOrder $order
 * @property ResPartner $addressAllotment
 * @property ProductProduct $product
 * @property ProductUom $productUos
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property SaleOrderLinePropertyRel[] $saleOrderLinePropertyRels
 */
class SaleOrderLine extends \yii\db\ActiveRecord
{
    public $subtotal;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_order_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'product_uom', 'sequence', 'order_id', 'product_uos', 'company_id', 'salesman_id', 'product_id', 'order_partner_id', 'address_allotment_id', 'procurement_id', 'product_packaging'], 'integer'],
            [['create_date', 'write_date','subtotal'], 'safe'],
            [['product_uos_qty', 'price_unit', 'product_uom_qty', 'discount', 'th_weight', 'delay', 'product_onhand', 'product_future', 'discount_nominal','subtotal'], 'number'],
            [['product_uom', 'order_id', 'price_unit', 'product_uom_qty', 'name', 'state', 'type', 'delay'], 'required'],
            [['name', 'state', 'type'], 'string'],
            [['invoiced'], 'boolean']
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
            'product_uos_qty' => 'Product Uos Qty',
            'product_uom' => 'Product Uom',
            'sequence' => 'Sequence',
            'order_id' => 'Order ID',
            'price_unit' => 'Price Unit',
            'product_uom_qty' => 'Product Uom Qty',
            'discount' => 'Discount',
            'product_uos' => 'Product Uos',
            'name' => 'Name',
            'company_id' => 'Company ID',
            'salesman_id' => 'Salesman ID',
            'state' => 'State',
            'product_id' => 'Product ID',
            'order_partner_id' => 'Order Partner ID',
            'th_weight' => 'Th Weight',
            'invoiced' => 'Invoiced',
            'type' => 'Type',
            'address_allotment_id' => 'Address Allotment ID',
            'procurement_id' => 'Procurement ID',
            'delay' => 'Delay',
            'product_packaging' => 'Product Packaging',
            'product_onhand' => 'Product Onhand',
            'product_future' => 'Product Future',
            'discount_nominal' => 'Discount Nominal',
        ];
    }

    public function afterFind(){
        $this->subtotal = floatval($this->product_uom_qty*$this->price_unit);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLineInvoiceRels()
    {
        return $this->hasMany(SaleOrderLineInvoiceRel::className(), ['order_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderTaxes()
    {
        return $this->hasMany(SaleOrderTax::className(), ['order_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['sale_line_id' => 'id']);
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
    public function getProcurement()
    {
        return $this->hasOne(ProcurementOrder::className(), ['id' => 'procurement_id']);
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
    public function getOrder()
    {
        return $this->hasOne(SaleOrder::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddressAllotment()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'address_allotment_id']);
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
    public function getProductUos()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'product_uos']);
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
    public function getSaleOrderLinePropertyRels()
    {
        return $this->hasMany(SaleOrderLinePropertyRel::className(), ['order_id' => 'id']);
    }
}
