<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_sales".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $name
 * @property boolean $is_main_group
 * @property integer $parent_id
 * @property string $desc
 *
 * @property ResUsers[] $resUsers
 * @property GroupSales $parent
 * @property GroupSales[] $groupSales
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property GroupSalesLine[] $groupSalesLines
 * @property SaleOrder[] $saleOrders
 */
class GroupSales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'parent_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['name', 'is_main_group'], 'required'],
            [['name', 'desc'], 'string'],
            [['is_main_group'], 'boolean']
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
            'is_main_group' => 'Is Main Group',
            'parent_id' => 'Parent ID',
            'desc' => 'Desc',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResUsers()
    {
        return $this->hasMany(ResUsers::className(), ['kelompok_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(GroupSales::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupSales()
    {
        return $this->hasMany(GroupSales::className(), ['parent_id' => 'id']);
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
    public function getGroupSalesLines()
    {
        return $this->hasMany(GroupSalesLine::className(), ['kelompok_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrders()
    {
        return $this->hasMany(SaleOrder::className(), ['group_id' => 'id']);
    }
}
