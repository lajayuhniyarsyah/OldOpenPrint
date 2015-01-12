<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_move".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property string $product_uos_qty
 * @property string $date_expected
 * @property integer $product_uom
 * @property string $price_unit
 * @property string $date
 * @property integer $prodlot_id
 * @property integer $move_dest_id
 * @property string $product_qty
 * @property integer $product_uos
 * @property integer $partner_id
 * @property string $note
 * @property integer $product_id
 * @property boolean $auto_validate
 * @property integer $price_currency_id
 * @property integer $location_id
 * @property integer $company_id
 * @property integer $picking_id
 * @property string $priority
 * @property string $state
 * @property integer $location_dest_id
 * @property integer $tracking_id
 * @property integer $product_packaging
 * @property integer $purchase_line_id
 * @property integer $sale_line_id
 * @property integer $production_id
 * @property string $weight
 * @property string $weight_net
 * @property integer $weight_uom_id
 * @property integer $no_moved0
 * @property string $no_moved1
 * @property string $name
 * @property string $desc
 * @property integer $no
 * @property integer $set_id
 *
 * @property StockMoveHistoryIds[] $stockMoveHistoryIds
 * @property StockReturnPickingMemory[] $stockReturnPickingMemories
 * @property StockInventoryMoveRel[] $stockInventoryMoveRels
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property MoveSetData $set
 * @property ProductUom $weightUom
 * @property MrpProduction $production
 * @property SaleOrderLine $saleLine
 * @property PurchaseOrderLine $purchaseLine
 * @property StockLocation $location
 * @property ResCurrency $priceCurrency
 * @property StockMove $moveDest
 * @property StockMove[] $stockMoves
 * @property ResCompany $company
 * @property StockPicking $picking
 * @property ResPartner $partner
 * @property ProductUom $productUos
 * @property StockTracking $tracking
 * @property StockLocation $locationDest
 * @property ProductProduct $product
 * @property StockProductionLot $prodlot
 * @property ProductPackaging $productPackaging
 * @property ProductUom $productUom
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property PurchaseOrderLine[] $purchaseOrderLines
 * @property MrpProductionMoveIds[] $mrpProductionMoveIds
 * @property ProcurementOrder[] $procurementOrders
 * @property MrpProduction[] $mrpProductions
 */
class StockMove extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_move';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'product_uom', 'prodlot_id', 'move_dest_id', 'product_uos', 'partner_id', 'product_id', 'price_currency_id', 'location_id', 'company_id', 'picking_id', 'location_dest_id', 'tracking_id', 'product_packaging', 'purchase_line_id', 'sale_line_id', 'production_id', 'weight_uom_id', 'no_moved0', 'no', 'set_id'], 'integer'],
            [['create_date', 'write_date', 'date_expected', 'date'], 'safe'],
            [['product_uos_qty', 'price_unit', 'product_qty', 'weight', 'weight_net'], 'number'],
            [['date_expected', 'product_uom', 'date', 'product_qty', 'product_id', 'location_id', 'company_id', 'location_dest_id', 'weight_uom_id'], 'required'],
            [['note', 'priority', 'state', 'name', 'desc'], 'string'],
            [['auto_validate'], 'boolean'],
            [['origin'], 'string', 'max' => 64],
            [['no_moved1'], 'string', 'max' => 3]
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
            'origin' => 'Source',
            'product_uos_qty' => 'Quantity (UOS)',
            'date_expected' => 'Scheduled Date',
            'product_uom' => 'Unit of Measure',
            'price_unit' => 'Unit Price',
            'date' => 'Date',
            'prodlot_id' => 'Serial Number',
            'move_dest_id' => 'Destination Move',
            'product_qty' => 'Quantity',
            'product_uos' => 'Product UOS',
            'partner_id' => 'Destination Address ',
            'note' => 'Notes',
            'product_id' => 'Product',
            'auto_validate' => 'Auto Validate',
            'price_currency_id' => 'Currency for average price',
            'location_id' => 'Source Location',
            'company_id' => 'Company',
            'picking_id' => 'Reference',
            'priority' => 'Priority',
            'state' => 'Status',
            'location_dest_id' => 'Destination Location',
            'tracking_id' => 'Pack',
            'product_packaging' => 'Packaging',
            'purchase_line_id' => 'Purchase Order Line',
            'sale_line_id' => 'Sales Order Line',
            'production_id' => 'Production',
            'weight' => 'Weight',
            'weight_net' => 'Net weight',
            'weight_uom_id' => 'Unit of Measure',
            'no_moved0' => 'No',
            'no_moved1' => 'No',
            'name' => 'Name',
            'desc' => 'Desc',
            'no' => 'No',
            'set_id' => 'Set Product',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveHistoryIds()
    {
        return $this->hasMany(StockMoveHistoryIds::className(), ['child_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockReturnPickingMemories()
    {
        return $this->hasMany(StockReturnPickingMemory::className(), ['move_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryMoveRels()
    {
        return $this->hasMany(StockInventoryMoveRel::className(), ['move_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['move_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['move_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSet()
    {
        return $this->hasOne(MoveSetData::className(), ['id' => 'set_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeightUom()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'weight_uom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduction()
    {
        return $this->hasOne(MrpProduction::className(), ['id' => 'production_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleLine()
    {
        return $this->hasOne(SaleOrderLine::className(), ['id' => 'sale_line_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseLine()
    {
        return $this->hasOne(PurchaseOrderLine::className(), ['id' => 'purchase_line_id']);
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
    public function getPriceCurrency()
    {
        return $this->hasOne(ResCurrency::className(), ['id' => 'price_currency_id']);
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
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['move_dest_id' => 'id']);
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
    public function getPicking()
    {
        return $this->hasOne(StockPicking::className(), ['id' => 'picking_id']);
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
    public function getProductUos()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'product_uos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTracking()
    {
        return $this->hasOne(StockTracking::className(), ['id' => 'tracking_id']);
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
    public function getProdlot()
    {
        return $this->hasOne(StockProductionLot::className(), ['id' => 'prodlot_id']);
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
    public function getPurchaseOrderLines()
    {
        return $this->hasMany(PurchaseOrderLine::className(), ['move_dest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductionMoveIds()
    {
        return $this->hasMany(MrpProductionMoveIds::className(), ['move_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders()
    {
        return $this->hasMany(ProcurementOrder::className(), ['move_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['move_prod_id' => 'id']);
    }
}
