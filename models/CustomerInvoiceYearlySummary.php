<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer_invoice_yearly_summary".
 *
 * @property integer $year_invoice
 * @property integer $user_id
 * @property string $summary
 */
class CustomerInvoiceYearlySummary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_invoice_yearly_summary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year_invoice', 'user_id'], 'integer'],
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
            'user_id' => 'User ID',
            'summary' => 'Summary',
        ];
    }
}
