<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_invoice_yearly_summary_validated".
 *
 * @property integer $year_invoice
 * @property integer $group_id
 * @property integer $user_id
 * @property string $summary
 */
class CustomerInvoiceYearlySummaryValidated extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_invoice_yearly_summary_validated';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_invoice', 'group_id', 'user_id'], 'integer'],
            [['summary'], 'number']
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
            'summary' => 'Summary',
        ];
    }
}
