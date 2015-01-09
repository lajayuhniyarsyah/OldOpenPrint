<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase_order_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $product_uom
 * @property integer $order_id
 * @property string $price_unit
 * @property integer $move_dest_id
 * @property string $product_qty
 * @property integer $partner_id
 * @property boolean $invoiced
 * @property string $name
 * @property string $date_planned
 * @property integer $company_id
 * @property string $state
 * @property integer $product_id
 * @property integer $account_analytic_id
 * @property integer $product_pb_id
 * @property integer $pb_id
 * @property integer $wo_id
 * @property integer $line_pb_subcont_id
 * @property integer $line_pb_general_id
 * @property integer $line_pb_rent_id
 * @property string $discount
 * @property string $discount_nominal
 * @property string $note_line
 * @property string $part_number
 * @property integer $no
 * @property integer $variants
 *
 * @property StockMove[] $stockMoves
 * @property PurchaseOrderTaxe[] $purchaseOrderTaxes
 * @property PurchaseOrderLineInvoiceRel[] $purchaseOrderLineInvoiceRels
 * @property ProductVariants $variants0
 * @property MrpProduction $wo
 * @property ResCompany $company
 * @property ResPartner $partner
 * @property ResUsers $writeU
 * @property ProductUom $productUom
 * @property PurchaseRequisitionSubcontLine $productPb
 * @property ProductProduct $product
 * @property PurchaseRequisitionSubcont $pb
 * @property PurchaseOrder $order
 * @property StockMove $moveDest
 * @property PurchaseRequisitionSubcontLine $linePbSubcont
 * @property RentRequisitionDetail $linePbRent
 * @property DetailPb $linePbGeneral
 * @property ResUsers $createU
 * @property AccountAnalyticAccount $accountAnalytic
 * @property WizardPoCancelItemLine[] $wizardPoCancelItemLines
 */
class PurchaseOrderLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'product_uom', 'order_id', 'move_dest_id', 'partner_id', 'company_id', 'product_id', 'account_analytic_id', 'product_pb_id', 'pb_id', 'wo_id', 'line_pb_subcont_id', 'line_pb_general_id', 'line_pb_rent_id', 'no', 'variants'], 'integer'],
            [['create_date', 'write_date', 'date_planned'], 'safe'],
            [['product_uom', 'order_id', 'price_unit', 'product_qty', 'name', 'state'], 'required'],
            [['price_unit', 'product_qty', 'discount', 'discount_nominal'], 'number'],
            [['invoiced'], 'boolean'],
            [['name', 'state', 'note_line', 'part_number'], 'string']
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
            'product_uom' => 'Product Uom',
            'order_id' => 'Order ID',
            'price_unit' => 'Price Unit',
            'move_dest_id' => 'Move Dest ID',
            'product_qty' => 'Product Qty',
            'partner_id' => 'Partner ID',
            'invoiced' => 'Invoiced',
            'name' => 'Name',
            'date_planned' => 'Date Planned',
            'company_id' => 'Company ID',
            'state' => 'State',
            'product_id' => 'Product ID',
            'account_analytic_id' => 'Account Analytic ID',
            'product_pb_id' => 'Product Pb ID',
            'pb_id' => 'Pb ID',
            'wo_id' => 'Wo ID',
            'line_pb_subcont_id' => 'Line Pb Subcont ID',
            'line_pb_general_id' => 'Line Pb General ID',
            'line_pb_rent_id' => 'Line Pb Rent ID',
            'discount' => 'Discount',
            'discount_nominal' => 'Discount Nominal',
            'note_line' => 'Note Line',
            'part_number' => 'Part Number',
            'no' => 'No',
            'variants' => 'Variants',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['purchase_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderTaxes()
    {
        return $this->hasMany(PurchaseOrderTaxe::className(), ['ord_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineInvoiceRels()
    {
        return $this->hasMany(PurchaseOrderLineInvoiceRel::className(), ['order_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariants0()
    {
        return $this->hasOne(ProductVariants::className(), ['id' => 'variants']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWo()
    {
        return $this->hasOne(MrpProduction::className(), ['id' => 'wo_id']);
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
    public function getProductUom()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'product_uom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPb()
    {
        return $this->hasOne(PurchaseRequisitionSubcontLine::className(), ['id' => 'product_pb_id']);
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
    public function getPb()
    {
        return $this->hasOne(PurchaseRequisitionSubcont::className(), ['id' => 'pb_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(PurchaseOrder::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoveDest()
    {
        return $this->hasOne(StockMove::className(), ['id' => 'move_dest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinePbSubcont()
    {
        return $this->hasOne(PurchaseRequisitionSubcontLine::className(), ['id' => 'line_pb_subcont_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinePbRent()
    {
        return $this->hasOne(RentRequisitionDetail::className(), ['id' => 'line_pb_rent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinePbGeneral()
    {
        return $this->hasOne(DetailPb::className(), ['id' => 'line_pb_general_id']);
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
    public function getAccountAnalytic()
    {
        return $this->hasOne(AccountAnalyticAccount::className(), ['id' => 'account_analytic_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoCancelItemLines()
    {
        return $this->hasMany(WizardPoCancelItemLine::className(), ['line_id' => 'id']);
    }
}
