<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_location".
 *
 * @property integer $id
 * @property integer $parent_left
 * @property integer $parent_right
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $comment
 * @property integer $chained_delay
 * @property integer $chained_company_id
 * @property boolean $active
 * @property integer $posz
 * @property integer $posx
 * @property integer $posy
 * @property integer $valuation_in_account_id
 * @property integer $partner_id
 * @property string $icon
 * @property integer $valuation_out_account_id
 * @property boolean $scrap_location
 * @property string $name
 * @property integer $chained_location_id
 * @property integer $chained_journal_id
 * @property string $chained_picking_type
 * @property integer $company_id
 * @property string $chained_auto_packing
 * @property string $complete_name
 * @property string $usage
 * @property integer $location_id
 * @property string $chained_location_type
 *
 * @property StockMoveScrap[] $stockMoveScraps
 * @property StockMoveConsume[] $stockMoveConsumes
 * @property StockFillInventory[] $stockFillInventories
 * @property StockInventoryLineSplit[] $stockInventoryLineSplits
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockWarehouse[] $stockWarehouses
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockMoveSplit[] $stockMoveSplits
 * @property StockPicking[] $stockPickings
 * @property StockMove[] $stockMoves
 * @property StockWarehouseOrderpoint[] $stockWarehouseOrderpoints
 * @property PurchaseOrder[] $purchaseOrders
 * @property MrpRouting[] $mrpRoutings
 * @property ProcurementOrder[] $procurementOrders
 * @property MrpProduction[] $mrpProductions
 * @property PerintahKerjaInternal[] $perintahKerjaInternals
 * @property ResCompany $chainedCompany
 * @property StockLocation $location
 * @property StockLocation[] $stockLocations
 * @property ResPartner $partner
 * @property ResCompany $company
 * @property AccountAccount $valuationInAccount
 * @property StockJournal $chainedJournal
 * @property StockLocation $chainedLocation
 * @property AccountAccount $valuationOutAccount
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property PerintahKerja[] $perintahKerjas
 * @property MoveSetData[] $moveSetDatas
 */
class StockLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_left', 'parent_right', 'create_uid', 'write_uid', 'chained_delay', 'chained_company_id', 'posz', 'posx', 'posy', 'valuation_in_account_id', 'partner_id', 'valuation_out_account_id', 'chained_location_id', 'chained_journal_id', 'company_id', 'location_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['comment', 'chained_picking_type', 'chained_auto_packing', 'usage', 'chained_location_type'], 'string'],
            [['active', 'scrap_location'], 'boolean'],
            [['name', 'chained_auto_packing', 'usage', 'chained_location_type'], 'required'],
            [['icon', 'name'], 'string', 'max' => 64],
            [['complete_name'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_left' => 'Parent Left',
            'parent_right' => 'Parent Right',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'comment' => 'Additional Information',
            'chained_delay' => 'Chaining Lead Time',
            'chained_company_id' => 'Chained Company',
            'active' => 'Active',
            'posz' => 'Height (Z)',
            'posx' => 'Corridor (X)',
            'posy' => 'Shelves (Y)',
            'valuation_in_account_id' => 'Stock Valuation Account (Incoming)',
            'partner_id' => 'Location Address',
            'icon' => 'Icon',
            'valuation_out_account_id' => 'Stock Valuation Account (Outgoing)',
            'scrap_location' => 'Scrap Location',
            'name' => 'Location Name',
            'chained_location_id' => 'Chained Location If Fixed',
            'chained_journal_id' => 'Chaining Journal',
            'chained_picking_type' => 'Shipping Type',
            'company_id' => 'Company',
            'chained_auto_packing' => 'Chaining Type',
            'complete_name' => 'Location Name',
            'usage' => 'Location Type',
            'location_id' => 'Parent Location',
            'chained_location_type' => 'Chained Location Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveScraps()
    {
        return $this->hasMany(StockMoveScrap::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveConsumes()
    {
        return $this->hasMany(StockMoveConsume::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockFillInventories()
    {
        return $this->hasMany(StockFillInventory::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplits()
    {
        return $this->hasMany(StockInventoryLineSplit::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeProductQties()
    {
        return $this->hasMany(StockChangeProductQty::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouses()
    {
        return $this->hasMany(StockWarehouse::className(), ['lot_output_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['location_dest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLines()
    {
        return $this->hasMany(StockInventoryLine::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['location_dest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplits()
    {
        return $this->hasMany(StockMoveSplit::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['location_dest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockWarehouseOrderpoints()
    {
        return $this->hasMany(StockWarehouseOrderpoint::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpRoutings()
    {
        return $this->hasMany(MrpRouting::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcurementOrders()
    {
        return $this->hasMany(ProcurementOrder::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpProductions()
    {
        return $this->hasMany(MrpProduction::className(), ['location_src_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerintahKerjaInternals()
    {
        return $this->hasMany(PerintahKerjaInternal::className(), ['location_src_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChainedCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'chained_company_id']);
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
    public function getStockLocations()
    {
        return $this->hasMany(StockLocation::className(), ['chained_location_id' => 'id']);
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
    public function getCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValuationInAccount()
    {
        return $this->hasOne(AccountAccount::className(), ['id' => 'valuation_in_account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChainedJournal()
    {
        return $this->hasOne(StockJournal::className(), ['id' => 'chained_journal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChainedLocation()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'chained_location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValuationOutAccount()
    {
        return $this->hasOne(AccountAccount::className(), ['id' => 'valuation_out_account_id']);
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
    public function getPerintahKerjas()
    {
        return $this->hasMany(PerintahKerja::className(), ['location_src_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMoveSetDatas()
    {
        return $this->hasMany(MoveSetData::className(), ['location_dest_id' => 'id']);
    }
}
