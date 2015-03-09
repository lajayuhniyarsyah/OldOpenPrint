<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status_subline".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $line_id
 * @property string $begin
 * @property string $end
 * @property string $name
 * @property string $state
 *
 * @property WeekStatusLine $line
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class StatusSubline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_subline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'line_id'], 'integer'],
            [['create_date', 'write_date', 'begin', 'end'], 'safe'],
            [['line_id', 'name'], 'required'],
            [['name', 'state'], 'string']
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
            'line_id' => 'Line ID',
            'begin' => 'Begin',
            'end' => 'End',
            'name' => 'Name',
            'state' => 'State',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLine()
    {
        return $this->hasOne(WeekStatusLine::className(), ['id' => 'line_id']);
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
