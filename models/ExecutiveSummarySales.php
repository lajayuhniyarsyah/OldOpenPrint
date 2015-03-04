<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "executive_summary_sales".
 *
 * @property integer $year_invoice
 * @property integer $user_id
 * @property double $amount_target
 * @property double $ytd_target
 * @property string $name
 * @property boolean $is_current_year
 * @property string $ytd_sales_achievement
 * @property string $achievement
 */
class ExecutiveSummarySales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'executive_summary_sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_invoice', 'user_id'], 'integer'],
            [['amount_target', 'ytd_target', 'ytd_sales_achievement', 'achievement'], 'number'],
            [['is_current_year'], 'boolean'],
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
            'user_id' => 'User ID',
            'amount_target' => 'Amount Target',
            'ytd_target' => 'Ytd Target',
            'name' => 'Name',
            'is_current_year' => 'Is Current Year',
            'ytd_sales_achievement' => 'Ytd Sales Achievement',
            'achievement' => 'Achievement',
        ];
    }
}
