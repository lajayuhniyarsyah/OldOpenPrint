<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_product".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $ean13
 * @property integer $color
 * @property resource $image
 * @property string $price_extra
 * @property string $default_code
 * @property string $name_template
 * @property boolean $active
 * @property string $variants
 * @property resource $image_medium
 * @property resource $image_small
 * @property integer $product_tmpl_id
 * @property string $price_margin
 * @property boolean $track_outgoing
 * @property boolean $track_incoming
 * @property string $valuation
 * @property boolean $track_production
 * @property boolean $hr_expense_ok
 * @property string $partner_code
 * @property string $expired_date
 * @property string $batch_code
 * @property string $partner_desc
 * @property boolean $is_rent_item
 * @property boolean $not_stock
 *
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountMoveLine[] $accountMoveLines
 * @property CatatanLine[] $catatanLines
 * @property DeliveryCarrier[] $deliveryCarriers
 * @property DetailPb[] $detailPbs
 * @property HrExpenseLine[] $hrExpenseLines
 * @property MakeProcurement[] $makeProcurements
 * @property MrpProductionProductLine[] $mrpProductionProductLines
 * @property MoveSetData[] $moveSetDatas
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property PerintahKerjaLineInternal[] $perintahKerjaLineInternals
 * @property PurchaseOrderLineCancel[] $purchaseOrderLineCancels
 * @property WizardPoCancelItemLine[] $wizardPoCancelItemLines
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property MrpProduction[] $mrpProductions
 * @property OrderPreparationLine[] $orderPreparationLines
 * @property DeliveryNoteLine[] $deliveryNoteLines
 * @property MrpBom[] $mrpBoms
 * @property PerintahKerjaLine[] $perintahKerjaLines
 * @property ProductBatchLine[] $productBatchLines
 * @property ProcurementOrder[] $procurementOrders
 * @property ProductPackaging[] $productPackagings
 * @property ProductListLine[] $productListLines
 * @property ProductPricelistItem[] $productPricelistItems
 * @property InternalMoveRequestLine[] $internalMoveRequestLines
 * @property InternalMoveLine[] $internalMoveLines
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property StockMove[] $stockMoves
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property PurchaseOrderSubcontSentLine[] $purchaseOrderSubcontSentLines
 * @property PurchaseRequisitionSubcontLine[] $purchaseRequisitionSubcontLines
 * @property PurchaseRequisitionSubcontLineToSend[] $purchaseRequisitionSubcontLineToSends
 * @property PurchaseRequisitionSubcontSendLine[] $purchaseRequisitionSubcontSendLines
 * @property RawMaterialLine[] $rawMaterialLines
 * @property ResUsers $writeU
 * @property ProductTemplate $productTmpl
 * @property ResUsers $createU
 * @property RentRequisitionDetail[] $rentRequisitionDetails
 * @property SaleAdvancePaymentInv[] $saleAdvancePaymentInvs
 * @property SaleOrderLine[] $saleOrderLines
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockProductionLot[] $stockProductionLots
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockMoveSplit[] $stockMoveSplits
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories
 * @property WeekStatusLine[] $weekStatusLines
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property SuperNoteProductRel[] $superNoteProductRels
 * @property InternalMoveLineDetail[] $internalMoveLineDetails
 * @property WizardDetailPb[] $wizardDetailPbs
 * @property WizardRentRequisitionDetail[] $wizardRentRequisitionDetails
 */
class ProductProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'color', 'product_tmpl_id'], 'integer'],
            [['create_date', 'write_date', 'expired_date'], 'safe'],
            [['image', 'image_medium', 'image_small', 'valuation'], 'string'],
            [['price_extra', 'price_margin'], 'number'],
            [['active', 'track_outgoing', 'track_incoming', 'track_production', 'hr_expense_ok', 'is_rent_item', 'not_stock'], 'boolean'],
            [['product_tmpl_id', 'valuation'], 'required'],
            [['ean13'], 'string', 'max' => 13],
            [['default_code', 'variants', 'partner_code', 'batch_code'], 'string', 'max' => 64],
            [['name_template'], 'string', 'max' => 128],
            [['partner_desc'], 'string', 'max' => 254],
            [['default_code'], 'unique'],
            [['name_template'], 'unique']
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
            'ean13' => 'EAN13 Barcode',
            'color' => 'Color Index',
            'image' => 'Image',
            'price_extra' => 'Variant Price Extra',
            'default_code' => 'Internal Reference',
            'name_template' => 'Template Name',
            'active' => 'Active',
            'variants' => 'Variants',
            'image_medium' => 'Medium-sized image',
            'image_small' => 'Small-sized image',
            'product_tmpl_id' => 'Product Template',
            'price_margin' => 'Variant Price Margin',
            'track_outgoing' => 'Track Outgoing Lots',
            'track_incoming' => 'Track Incoming Lots',
            'valuation' => 'Inventory Valuation',
            'track_production' => 'Track Manufacturing Lots',
            'hr_expense_ok' => 'Can be Expensed',
            'partner_code' => 'Partner Code',
            'expired_date' => 'Expired Date',
            'batch_code' => 'Batch No',
            'partner_desc' => 'Partner Description',
            'is_rent_item' => 'Is Rent Item',
            'not_stock' => 'Not Stock',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticLines()
    {
        return $this->hasMany(AccountAnalyticLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines()
    {
        return $this->hasMany(AccountMoveLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatatanLines()
    {
        return $this->hasMany(CatatanLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryCarriers()
    {
        return $this->hasMany(DeliveryCarrier::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPbs()
    {
        return $this->hasMany(DetailPb::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseLines()
    {
        return $this->hasMany(HrExpenseLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakeProcurements()
    {
        return $this->hasMany(MakeProcurement::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionProductLines()
    {
        return $this->hasMany(MrpProductionProductLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoveSetDatas()
    {
        return $this->hasMany(MoveSetData::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpWorkcenters()
    {
        return $this->hasMany(MrpWorkcenter::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLineInternals()
    {
        return $this->hasMany(PerintahKerjaLineInternal::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineCancels()
    {
        return $this->hasMany(PurchaseOrderLineCancel::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoCancelItemLines()
    {
        return $this->hasMany(WizardPoCancelItemLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveScraps()
    {
        return $this->hasMany(StockMoveScrap::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveConsumes()
    {
        return $this->hasMany(StockMoveConsume::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationLines()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLines()
    {
        return $this->hasMany(DeliveryNoteLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpBoms()
    {
        return $this->hasMany(MrpBom::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLines()
    {
        return $this->hasMany(PerintahKerjaLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductBatchLines()
    {
        return $this->hasMany(ProductBatchLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders()
    {
        return $this->hasMany(ProcurementOrder::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPackagings()
    {
        return $this->hasMany(ProductPackaging::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductListLines()
    {
        return $this->hasMany(ProductListLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistItems()
    {
        return $this->hasMany(ProductPricelistItem::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveRequestLines()
    {
        return $this->hasMany(InternalMoveRequestLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLines()
    {
        return $this->hasMany(InternalMoveLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLines()
    {
        return $this->hasMany(AccountInvoiceLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLines()
    {
        return $this->hasMany(PurchaseOrderLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderSubcontSentLines()
    {
        return $this->hasMany(PurchaseOrderSubcontSentLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLineToSends()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLineToSend::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontSendLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontSendLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRawMaterialLines()
    {
        return $this->hasMany(RawMaterialLine::className(), ['product_id' => 'id']);
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
    public function getProductTmpl()
    {
        return $this->hasOne(ProductTemplate::className(), ['id' => 'product_tmpl_id']);
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
    public function getRentRequisitionDetails()
    {
        return $this->hasMany(RentRequisitionDetail::className(), ['name' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleAdvancePaymentInvs()
    {
        return $this->hasMany(SaleAdvancePaymentInv::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLines()
    {
        return $this->hasMany(SaleOrderLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeProductQties()
    {
        return $this->hasMany(StockChangeProductQty::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplits()
    {
        return $this->hasMany(StockInventoryLineSplit::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLots()
    {
        return $this->hasMany(StockProductionLot::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLines()
    {
        return $this->hasMany(StockInventoryLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplits()
    {
        return $this->hasMany(StockMoveSplit::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockReturnPickingMemories()
    {
        return $this->hasMany(StockReturnPickingMemory::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatusLines()
    {
        return $this->hasMany(WeekStatusLine::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouseOrderpoints()
    {
        return $this->hasMany(StockWarehouseOrderpoint::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperNoteProductRels()
    {
        return $this->hasMany(SuperNoteProductRel::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLineDetails()
    {
        return $this->hasMany(InternalMoveLineDetail::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardDetailPbs()
    {
        return $this->hasMany(WizardDetailPb::className(), ['product' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardRentRequisitionDetails()
    {
        return $this->hasMany(WizardRentRequisitionDetail::className(), ['product' => 'id']);
    }

    /**
     * [getSuperNotes description]
     * @return ActiveRecord
     */
    public function getSuperNotes()
    {
        // return $this->hasMany(SuperNoteProductRel::className(),['product_id'=>'id'])->viaTable(SuperNotes::className(),['id'=>'id']);

        // return $this->hasMany(SuperNoteProductRel::className(),['product_id'=>'id']);
        return $this->hasMany(SuperNotes::className(),['id'=>'super_note_id'])->via('superNoteProductRels');
    }
}
