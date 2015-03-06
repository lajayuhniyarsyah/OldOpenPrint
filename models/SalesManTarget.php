<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales_man_target".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property double $amount_target
 * @property integer $user_id
 * @property string $name
 * @property string $year
 *
 * @property ResUsers $user
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class SalesManTarget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_man_target';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'user_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['amount_target', 'user_id', 'name', 'year'], 'required'],
            [['amount_target'], 'number'],
            [['name', 'year'], 'string']
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
            'amount_target' => 'Amount Target',
            'user_id' => 'User ID',
            'name' => 'Name',
            'year' => 'Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'user_id']);
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
