<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "internal_move_request".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $due_date
 * @property string $name
 * @property string $ref_no
 * @property string $notes
 * @property integer $destination
 * @property string $manual_pb_no
 * @property integer $source
 * @property string $state
 * @property integer $request_by
 *
 * @property ResUsers $requestBy
 * @property StockLocation $destination0
 * @property StockLocation $source0
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property InternalMoveRequestLine[] $internalMoveRequestLines
 * @property InternalMove[] $internalMoves
 */
class InternalMoveRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'internal_move_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'destination', 'source', 'request_by'], 'integer'],
            [['create_date', 'write_date', 'due_date'], 'safe'],
            [['due_date', 'name', 'destination', 'source', 'request_by'], 'required'],
            [['name', 'ref_no', 'notes', 'manual_pb_no', 'state'], 'string']
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
            'due_date' => 'Due Date',
            'name' => 'MR No',
            'ref_no' => 'Ref No',
            'notes' => 'Notes',
            'destination' => 'Destination Location',
            'manual_pb_no' => 'Manual PB NO',
            'source' => 'Source Location',
            'state' => 'unknown',
            'request_by' => 'Request By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestBy()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'request_by']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoveRequestLines()
    {
        return $this->hasMany(InternalMoveRequestLine::className(), ['internal_move_request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInternalMoves()
    {
        return $this->hasMany(InternalMove::className(), ['internal_move_request_id' => 'id']);
    }
}
