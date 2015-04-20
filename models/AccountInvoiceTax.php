<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_invoice_tax".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $tax_amount
 * @property integer $account_id
 * @property integer $sequence
 * @property integer $invoice_id
 * @property boolean $manual
 * @property integer $company_id
 * @property string $base_amount
 * @property string $amount
 * @property string $base
 * @property integer $tax_code_id
 * @property integer $account_analytic_id
 * @property integer $base_code_id
 * @property string $name
 *
 * @property AccountAccount $account
 * @property AccountTaxCode $taxCode
 * @property AccountTaxCode $baseCode
 * @property AccountInvoice $invoice
 * @property AccountAnalyticAccount $accountAnalytic
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class AccountInvoiceTax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_invoice_tax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'account_id', 'sequence', 'invoice_id', 'company_id', 'tax_code_id', 'account_analytic_id', 'base_code_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['tax_amount', 'base_amount', 'amount', 'base'], 'number'],
            [['account_id', 'name'], 'required'],
            [['manual'], 'boolean'],
            [['name'], 'string', 'max' => 64]
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
            'tax_amount' => 'Tax Amount',
            'account_id' => 'Account ID',
            'sequence' => 'Sequence',
            'invoice_id' => 'Invoice ID',
            'manual' => 'Manual',
            'company_id' => 'Company ID',
            'base_amount' => 'Base Amount',
            'amount' => 'Amount',
            'base' => 'Base',
            'tax_code_id' => 'Tax Code ID',
            'account_analytic_id' => 'Account Analytic ID',
            'base_code_id' => 'Base Code ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(AccountAccount::className(), ['id' => 'account_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxCode()
    {
        return $this->hasOne(AccountTaxCode::className(), ['id' => 'tax_code_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseCode()
    {
        return $this->hasOne(AccountTaxCode::className(), ['id' => 'base_code_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(AccountInvoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalytic()
    {
        return $this->hasOne(AccountAnalyticAccount::className(), ['id' => 'account_analytic_id']);
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
