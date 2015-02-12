<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internal_move".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $due_date_preparation
 * @property string $name
 * @property integer $destination
 * @property integer $internal_move_request_id
 * @property integer $source
 * @property string $state
 * @property string $due_date_transfer
 * @property string $date_prepared
 * @property integer $picking_id
 * @property string $ref_no
 * @property string $manual_pb_no
 *
 * @property InternalMoveLine[] $internalMoveLines
 * @property StockPicking $picking
 * @property InternalMoveRequest $internalMoveRequest
 * @property StockLocation $destination0
 * @property StockLocation $source0
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class InternalMove extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'internal_move';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'destination', 'internal_move_request_id', 'source', 'picking_id'], 'integer'],
            [['create_date', 'write_date', 'due_date_preparation', 'due_date_transfer', 'date_prepared'], 'safe'],
            [['name', 'state', 'ref_no', 'manual_pb_no'], 'string'],
            [['destination', 'internal_move_request_id', 'source'], 'required']
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
            'due_date_preparation' => 'Preparation Due Date',
            'name' => 'I.M No.',
            'destination' => 'unknown',
            'internal_move_request_id' => 'Request No',
            'source' => 'unknown',
            'state' => 'unknown',
            'due_date_transfer' => 'Transfer Due Date',
            'date_prepared' => 'Prepared Date',
            'picking_id' => 'Picking',
            'ref_no' => 'Ref No',
            'manual_pb_no' => 'PB No',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveLines()
    {
        return $this->hasMany(InternalMoveLine::className(), ['internal_move_id' => 'id'])->orderBy('no, id ASC');
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
    public function getInternalMoveRequest()
    {
        return $this->hasOne(InternalMoveRequest::className(), ['id' => 'internal_move_request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestination0()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'destination']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource0()
    {
        return $this->hasOne(StockLocation::className(), ['id' => 'source']);
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
