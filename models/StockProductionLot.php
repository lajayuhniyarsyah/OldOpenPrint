<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_production_lot".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property integer $company_id
 * @property string $prefix
 * @property integer $product_id
 * @property string $date
 * @property string $ref
 * @property string $desc
 * @property string $exp_date
 *
 * @property StockInventoryLine[] $stockInventoryLines
 * @property StockMove[] $stockMoves
 * @property StockChangeProductQty[] $stockChangeProductQties
 * @property StockInventoryLineSplitLines[] $stockInventoryLineSplitLines
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockProductionLotRevision[] $stockProductionLotRevisions
 * @property OrderPreparationLine[] $orderPreparationLines
 * @property StockMoveSplitLines[] $stockMoveSplitLines
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property ResUsers $writeU
 * @property ProductProduct $product
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property OrderPreparationBatch[] $orderPreparationBatches
 */
class StockProductionLot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_production_lot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'company_id', 'product_id'], 'integer'],
            [['create_date', 'write_date', 'date', 'exp_date'], 'safe'],
            [['name', 'product_id', 'date'], 'required'],
            [['desc'], 'string'],
            [['name', 'prefix'], 'string', 'max' => 64],
            [['ref'], 'string', 'max' => 256],
            [['name', 'ref'], 'unique', 'targetAttribute' => ['name', 'ref'], 'message' => 'The combination of Name and Ref has already been taken.']
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
            'name' => 'Name',
            'company_id' => 'Company ID',
            'prefix' => 'Prefix',
            'product_id' => 'Product ID',
            'date' => 'Date',
            'ref' => 'Ref',
            'desc' => 'Desc',
            'exp_date' => 'Exp Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLines()
    {
        return $this->hasMany(StockInventoryLine::className(), ['prod_lot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['prodlot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeProductQties()
    {
        return $this->hasMany(StockChangeProductQty::className(), ['prodlot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockInventoryLineSplitLines()
    {
        return $this->hasMany(StockInventoryLineSplitLines::className(), ['prodlot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['prodlot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockProductionLotRevisions()
    {
        return $this->hasMany(StockProductionLotRevision::className(), ['lot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationLines()
    {
        return $this->hasMany(OrderPreparationLine::className(), ['prodlot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoveSplitLines()
    {
        return $this->hasMany(StockMoveSplitLines::className(), ['prodlot_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['prodlot_id' => 'id']);
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
    public function getProduct()
    {
        return $this->hasOne(ProductProduct::className(), ['id' => 'product_id']);
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
    public function getCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderPreparationBatches()
    {
        return $this->hasMany(OrderPreparationBatch::className(), ['name' => 'id']);
    }
}
