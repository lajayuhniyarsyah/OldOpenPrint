<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "executive_summary_sales_validated".
 *
 * @property integer $year_invoice
 * @property integer $group_id
 * @property integer $user_id
 * @property double $amount_target
 * @property double $ytd_target
 * @property string $name
 * @property string $ytd_sales_achievement
 * @property string $achievement
 */
class ExecutiveSummarySalesValidated extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'executive_summary_sales_validated';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_invoice', 'group_id', 'user_id'], 'integer'],
            [['amount_target', 'ytd_target', 'ytd_sales_achievement', 'achievement'], 'number'],
            [['name'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year_invoice' => 'Year Invoice',
            'group_id' => 'Group ID',
            'user_id' => 'User ID',
            'amount_target' => 'Amount Target',
            'ytd_target' => 'Ytd Target',
            'name' => 'Name',
            'ytd_sales_achievement' => 'Ytd Sales Achievement',
            'achievement' => 'Achievement',
        ];
    }
}
