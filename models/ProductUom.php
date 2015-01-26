<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_uom".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $uom_type
 * @property integer $category_id
 * @property string $name
 * @property string $rounding
 * @property string $factor
 * @property boolean $active
 *
 * @property SaleConfigSettings[] $saleConfigSettings
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property ProductTemplate[] $productTemplates
 * @property DetailPb[] $detailPbs
 * @property RentRequisitionDetail[] $rentRequisitionDetails
 * @property WizardRentRequisitionDetail[] $wizardRentRequisitionDetails
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property ProductListLine[] $productListLines
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockMoveSplit[] $stockMoveSplits
 * @property MakeProcurement[] $makeProcurements
 * @property StockPicking[] $stockPickings
 * @property StockMove[] $stockMoves
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property SaleOrderLine[] $saleOrderLines
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property MrpProductionProductLine[] $mrpProductionProductLines
 * @property ProcurementOrder[] $procurementOrders
 * @property ProductUomCateg $category
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property MrpBom[] $mrpBoms
 * @property MrpProduction[] $mrpProductions
 * @property HrExpenseLine[] $hrExpenseLines
 * @property DeliveryNoteLine[] $deliveryNoteLines
 * @property OrderPreparationLine[] $orderPreparationLines
 * @property PerintahKerjaLine[] $perintahKerjaLines
 * @property CatatanLine[] $catatanLines
 * @property AccountMoveLine[] $accountMoveLines
 * @property PerintahKerjaLineInternal[] $perintahKerjaLineInternals
 * @property RawMaterialLine[] $rawMaterialLines
 * @property PurchaseRequisitionSubcontSendLine[] $purchaseRequisitionSubcontSendLines
 * @property PurchaseRequisitionSubcontLine[] $purchaseRequisitionSubcontLines
 * @property PurchaseRequisitionSubcontLineToSend[] $purchaseRequisitionSubcontLineToSends
 * @property PurchaseOrderSubcontSentLine[] $purchaseOrderSubcontSentLines
 * @property MoveSetData[] $moveSetDatas
 */
class ProductUom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_uom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'category_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['uom_type', 'category_id', 'name', 'rounding', 'factor'], 'required'],
            [['uom_type'], 'string'],
            [['rounding', 'factor'], 'number'],
            [['active'], 'boolean'],
            [['name'], 'string', 'max' => 64]
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
            'uom_type' => 'Type',
            'category_id' => 'Category',
            'name' => 'Unit of Measure',
            'rounding' => 'Rounding Precision',
            'factor' => 'Ratio',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleConfigSettings()
    {
        return $this->hasMany(SaleConfigSettings::className(), ['time_unit' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticLines()
    {
        return $this->hasMany(AccountAnalyticLine::className(), ['product_uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTemplates()
    {
        return $this->hasMany(ProductTemplate::className(), ['uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPbs()
    {
        return $this->hasMany(DetailPb::className(), ['satuan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRentRequisitionDetails()
    {
        return $this->hasMany(RentRequisitionDetail::className(), ['uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardRentRequisitionDetails()
    {
        return $this->hasMany(WizardRentRequisitionDetail::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLines()
    {
        return $this->hasMany(AccountInvoiceLine::className(), ['uos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductListLines()
    {
        return $this->hasMany(ProductListLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveScraps()
    {
        return $this->hasMany(StockMoveScrap::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveConsumes()
    {
        return $this->hasMany(StockMoveConsume::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplits()
    {
        return $this->hasMany(StockInventoryLineSplit::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLines()
    {
        return $this->hasMany(StockInventoryLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplits()
    {
        return $this->hasMany(StockMoveSplit::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMakeProcurements()
    {
        return $this->hasMany(MakeProcurement::className(), ['uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['weight_uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouseOrderpoints()
    {
        return $this->hasMany(StockWarehouseOrderpoint::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLines()
    {
        return $this->hasMany(SaleOrderLine::className(), ['product_uos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLines()
    {
        return $this->hasMany(PurchaseOrderLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionProductLines()
    {
        return $this->hasMany(MrpProductionProductLine::className(), ['product_uos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders()
    {
        return $this->hasMany(ProcurementOrder::className(), ['product_uos' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductUomCateg::className(), ['id' => 'category_id']);
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
    public function getMrpBoms()
    {
        return $this->hasMany(MrpBom::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseLines()
    {
        return $this->hasMany(HrExpenseLine::className(), ['uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryNoteLines()
    {
        return $this->hasMany(DeliveryNoteLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationLines()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLines()
    {
        return $this->hasMany(PerintahKerjaLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatatanLines()
    {
        return $this->hasMany(CatatanLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines()
    {
        return $this->hasMany(AccountMoveLine::className(), ['product_uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaLineInternals()
    {
        return $this->hasMany(PerintahKerjaLineInternal::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRawMaterialLines()
    {
        return $this->hasMany(RawMaterialLine::className(), ['product_uom' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontSendLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontSendLine::className(), ['product_uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLines()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLine::className(), ['product_uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseRequisitionSubcontLineToSends()
    {
        return $this->hasMany(PurchaseRequisitionSubcontLineToSend::className(), ['product_uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderSubcontSentLines()
    {
        return $this->hasMany(PurchaseOrderSubcontSentLine::className(), ['product_uom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoveSetDatas()
    {
        return $this->hasMany(MoveSetData::className(), ['product_uom' => 'id']);
    }
}
