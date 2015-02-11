<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_sales_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $name
 * @property integer $kelompok_id
 *
 * @property GroupSales $kelompok
 * @property ResUsers $user
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class GroupSalesLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_sales_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'name', 'kelompok_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['name'], 'required']
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
            'kelompok_id' => 'Kelompok ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelompok()
    {
        return $this->hasOne(GroupSales::className(), ['id' => 'kelompok_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'name']);
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
