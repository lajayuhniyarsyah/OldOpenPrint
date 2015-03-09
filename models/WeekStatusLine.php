<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "week_status_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $status
 * @property string $project
 * @property integer $name
 * @property integer $status_id
 * @property integer $order_id
 * @property string $amount
 * @property integer $currency_id
 * @property string $state
 * @property string $quotation
 * @property string $product_group
 * @property integer $product_id
 *
 * @property StatusSubline[] $statusSublines
 * @property WeekStatus $status0
 * @property ResCurrency $currency
 * @property ResPartner $name0
 * @property SaleOrder $order
 * @property ProductProduct $product
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property LogStatusCustomer[] $logStatusCustomers
 */
class WeekStatusLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'week_status_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'name', 'status_id', 'order_id', 'currency_id', 'product_id'], 'integer'],
            [['create_date', 'write_date', 'quotation'], 'safe'],
            [['status', 'project', 'name', 'status_id'], 'required'],
            [['status', 'state', 'product_group'], 'string'],
            [['amount'], 'number'],
            [['project'], 'string', 'max' => 64]
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
            'status' => 'Status',
            'project' => 'Project',
            'name' => 'Name',
            'status_id' => 'Status ID',
            'order_id' => 'Order ID',
            'amount' => 'Amount',
            'currency_id' => 'Currency ID',
            'state' => 'State',
            'quotation' => 'Quotation',
            'product_group' => 'Product Group',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusSublines()
    {
        return $this->hasMany(StatusSubline::className(), ['line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(WeekStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(ResCurrency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName0()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'name']);
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
    public function getProduct()
    {
        return $this->hasOne(ProductProduct::className(), ['id' => 'product_id']);
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
    public function getLogStatusCustomers()
    {
        return $this->hasMany(LogStatusCustomer::className(), ['week_id' => 'id']);
    }
}
