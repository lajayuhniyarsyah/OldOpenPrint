<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "before_plan_senin".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $activity_id
 * @property integer $partner_id
 * @property string $name
 * @property string $location
 * @property integer $order_id
 *
 * @property SaleOrder $order
 * @property SalesActivity $activity
 * @property ResPartner $partner
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property BeforeActualSenin[] $beforeActualSenins
 */
class BeforePlanSenin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'before_plan_senin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'activity_id', 'partner_id', 'order_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['activity_id', 'name', 'location'], 'required'],
            [['name'], 'string'],
            [['location'], 'string', 'max' => 64]
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
            'activity_id' => 'Activity ID',
            'partner_id' => 'Partner ID',
            'name' => 'Name',
            'location' => 'Location',
            'order_id' => 'Order ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(SaleOrder::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(SalesActivity::className(), ['id' => 'activity_id']);
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
    public function getBeforeActualSenins()
    {
        return $this->hasMany(BeforeActualSenin::className(), ['plan_id' => 'id']);
    }
}
