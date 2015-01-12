<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_picking".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property string $date_done
 * @property string $min_date
 * @property string $date
 * @property integer $partner_id
 * @property integer $stock_journal_id
 * @property integer $backorder_id
 * @property string $name
 * @property integer $location_id
 * @property string $move_type
 * @property integer $company_id
 * @property string $invoice_state
 * @property string $note
 * @property string $state
 * @property integer $location_dest_id
 * @property string $max_date
 * @property boolean $auto_picking
 * @property string $type
 * @property integer $purchase_id
 * @property integer $sale_id
 * @property integer $invoice_id
 * @property string $carrier_tracking_ref
 * @property integer $number_of_packages
 * @property integer $carrier_id
 * @property string $weight
 * @property integer $weight_uom_id
 * @property string $weight_net
 * @property double $volume
 * @property integer $note_id
 * @property string $cust_doc_ref
 * @property string $lbm_no
 * @property boolean $isset_set
 *
 * @property StockPartialMove[] $stockPartialMoves
 * @property StockPartialPicking[] $stockPartialPickings
 * @property DeliveryCarrier $carrier
 * @property DeliveryNote $note0
 * @property ProductUom $weightUom
 * @property AccountInvoice $invoice
 * @property SaleOrder $sale
 * @property PurchaseOrder $purchase
 * @property StockPicking $backorder
 * @property StockPicking[] $stockPickings
 * @property StockLocation $locationDest
 * @property ResCompany $company
 * @property StockLocation $location
 * @property ResPartner $partner
 * @property StockJournal $stockJournal
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property StockMove[] $stockMoves
 * @property MrpProduction[] $mrpProductions
 * @property MergeDoPickingRel[] $mergeDoPickingRels
 * @property OrderPreparation[] $orderPreparations
 * @property MoveSetData[] $moveSetDatas
 */
class StockPicking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_picking';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'partner_id', 'stock_journal_id', 'backorder_id', 'location_id', 'company_id', 'location_dest_id', 'purchase_id', 'sale_id', 'invoice_id', 'number_of_packages', 'carrier_id', 'weight_uom_id', 'note_id'], 'integer'],
            [['create_date', 'write_date', 'date_done', 'min_date', 'date', 'max_date'], 'safe'],
            [['move_type', 'company_id', 'invoice_state', 'type'], 'required'],
            [['move_type', 'invoice_state', 'note', 'state', 'type'], 'string'],
            [['auto_picking', 'isset_set'], 'boolean'],
            [['weight', 'weight_net', 'volume'], 'number'],
            [['origin', 'name'], 'string', 'max' => 64],
            [['carrier_tracking_ref'], 'string', 'max' => 32],
            [['cust_doc_ref', 'lbm_no'], 'string', 'max' => 200],
            [['name', 'company_id'], 'unique', 'targetAttribute' => ['name', 'company_id'], 'message' => 'The combination of Reference and Company has already been taken.']
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
            'origin' => 'Source Document',
            'date_done' => 'Date of Transfer',
            'min_date' => 'Scheduled Time',
            'date' => 'Creation Date',
            'partner_id' => 'Partner',
            'stock_journal_id' => 'Stock Journal',
            'backorder_id' => 'Back Order of',
            'name' => 'Reference',
            'location_id' => 'Location',
            'move_type' => 'Delivery Method',
            'company_id' => 'Company',
            'invoice_state' => 'Invoice Control',
            'note' => 'Notes',
            'state' => 'Status',
            'location_dest_id' => 'Dest. Location',
            'max_date' => 'Max. Expected Date',
            'auto_picking' => 'Auto-Picking',
            'type' => 'Shipping Type',
            'purchase_id' => 'Purchase Order',
            'sale_id' => 'Sales Order',
            'invoice_id' => 'Invoice',
            'carrier_tracking_ref' => 'Carrier Tracking Ref',
            'number_of_packages' => 'Number of Packages',
            'carrier_id' => 'Carrier',
            'weight' => 'Weight',
            'weight_uom_id' => 'Unit of Measure',
            'weight_net' => 'Net Weight',
            'volume' => 'Volume',
            'note_id' => 'Delivery Note',
            'cust_doc_ref' => 'External Doc Ref',
            'lbm_no' => 'LBM No',
            'isset_set' => 'Is Has Set',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoves()
    {
        return $this->hasMany(StockPartialMove::className(), ['picking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickings()
    {
        return $this->hasMany(StockPartialPicking::className(), ['picking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrier()
    {
        return $this->hasOne(DeliveryCarrier::className(), ['id' => 'carrier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNote0()
    {
        return $this->hasOne(DeliveryNote::className(), ['id' => 'note_id']);
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
    public function getInvoice()
    {
        return $this->hasOne(AccountInvoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSale()
    {
        return $this->hasOne(SaleOrder::className(), ['id' => 'sale_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchase()
    {
        return $this->hasOne(PurchaseOrder::className(), ['id' => 'purchase_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackorder()
    {
        return $this->hasOne(StockPicking::className(), ['id' => 'backorder_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['backorder_id' => 'id']);
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
    public function getCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
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
    public function getPartner()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockJournal()
    {
        return $this->hasOne(StockJournal::className(), ['id' => 'stock_journal_id']);
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
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['picking_id' => 'id'])->orderBy('no, id ASC');
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['picking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMergeDoPickingRels()
    {
        return $this->hasMany(MergeDoPickingRel::className(), ['picking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparations()
    {
        return $this->hasMany(OrderPreparation::className(), ['picking_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoveSetDatas()
    {
        return $this->hasMany(MoveSetData::className(), ['picking_id' => 'id']);
    }
}
