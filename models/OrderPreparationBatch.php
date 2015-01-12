<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_preparation_batch".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property double $stock_available
 * @property string $exp_date
 * @property integer $name
 * @property integer $batch_id
 * @property string $desc
 * @property double $qty
 *
 * @property StockProductionLot $name0
 * @property OrderPreparationLine $batch
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class OrderPreparationBatch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_preparation_batch';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'name', 'batch_id'], 'integer'],
            [['create_date', 'write_date', 'exp_date'], 'safe'],
            [['stock_available', 'qty'], 'number'],
            [['desc'], 'string']
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
            'stock_available' => 'Stock Available',
            'exp_date' => 'Exp Date',
            'name' => 'Name',
            'batch_id' => 'Batch ID',
            'desc' => 'Desc',
            'qty' => 'Qty',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName0()
    {
        return $this->hasOne(StockProductionLot::className(), ['id' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatch()
    {
        return $this->hasOne(OrderPreparationLine::className(), ['id' => 'batch_id']);
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
}
