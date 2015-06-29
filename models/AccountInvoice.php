<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_invoice".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property string $date_due
 * @property string $check_total
 * @property string $reference
 * @property string $supplier_invoice_number
 * @property string $number
 * @property integer $account_id
 * @property integer $company_id
 * @property integer $currency_id
 * @property integer $partner_id
 * @property integer $fiscal_position
 * @property integer $user_id
 * @property integer $partner_bank_id
 * @property integer $payment_term
 * @property string $reference_type
 * @property integer $journal_id
 * @property string $amount_tax
 * @property string $state
 * @property string $type
 * @property string $internal_number
 * @property boolean $reconciled
 * @property string $residual
 * @property string $move_name
 * @property string $date_invoice
 * @property integer $period_id
 * @property string $amount_untaxed
 * @property integer $move_id
 * @property string $amount_total
 * @property string $name
 * @property string $comment
 * @property boolean $sent
 * @property integer $commercial_partner_id
 * @property string $kmk
 * @property string $faktur_pajak_no
 * @property string $kwitansi
 * @property string $pajak
 * @property string $kurs
 * @property integer $approver
 *
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property ResUsers $approver0
 * @property ResCompany $company
 * @property AccountPeriod $period
 * @property ResUsers $user
 * @property AccountFiscalPosition $fiscalPosition
 * @property ResCurrency $currency
 * @property AccountJournal $journal
 * @property AccountAccount $account
 * @property ResPartnerBank $partnerBank
 * @property AccountPaymentTerm $paymentTerm
 * @property ResPartner $partner
 * @property AccountMove $move
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property SaleOrderInvoiceRel[] $saleOrderInvoiceRels
 * @property StockPicking[] $stockPickings
 * @property PurchaseInvoiceRel[] $purchaseInvoiceRels
 */
class AccountInvoice extends \yii\db\ActiveRecord
{
    public $partner_to_print;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'account_id', 'company_id', 'currency_id', 'partner_id', 'fiscal_position', 'user_id', 'partner_bank_id', 'payment_term', 'journal_id', 'period_id', 'move_id', 'commercial_partner_id', 'approver'], 'integer'],
            [['create_date', 'write_date', 'date_due', 'date_invoice','payment_for'], 'safe'],
            [['check_total', 'amount_tax', 'residual', 'amount_untaxed', 'amount_total', 'pajak', 'kurs','faktur_address'], 'number'],
            [['account_id', 'company_id', 'currency_id', 'partner_id', 'reference_type', 'journal_id'], 'required'],
            [['reference_type', 'state', 'type', 'comment'], 'string'],
            [['reconciled', 'sent','print_all_taxes_line'], 'boolean'],
            [['origin', 'reference', 'supplier_invoice_number', 'number', 'move_name', 'name', 'kmk', 'kwitansi'], 'string', 'max' => 64],
            [['internal_number'], 'string', 'max' => 32],
            [['faktur_pajak_no'], 'string', 'max' => 20],
            [['number', 'company_id', 'journal_id', 'type'], 'unique', 'targetAttribute' => ['number', 'company_id', 'journal_id', 'type'], 'message' => 'The combination of Number, Company, Journal and Type has already been taken.']
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
            'origin' => 'Source Document',
            'date_due' => 'Due Date',
            'check_total' => 'Verification Total',
            'reference' => 'Invoice Reference',
            'supplier_invoice_number' => 'Supplier Invoice Number',
            'number' => 'Number',
            'account_id' => 'Account',
            'company_id' => 'Company',
            'currency_id' => 'Currency',
            'partner_id' => 'Partner',
            'fiscal_position' => 'Fiscal Position',
            'user_id' => 'Salesperson',
            'partner_bank_id' => 'Bank Account',
            'payment_term' => 'Payment Terms',
            'reference_type' => 'Payment Reference',
            'journal_id' => 'Journal',
            'amount_tax' => 'Tax',
            'state' => 'Status',
            'type' => 'Type',
            'internal_number' => 'Invoice Number',
            'reconciled' => 'Paid/Reconciled',
            'residual' => 'Balance',
            'move_name' => 'Journal Entry',
            'date_invoice' => 'Invoice Date',
            'period_id' => 'Force Period',
            'amount_untaxed' => 'Subtotal',
            'move_id' => 'Journal Entry',
            'amount_total' => 'Total',
            'name' => 'Description',
            'comment' => 'Additional Information',
            'sent' => 'Sent',
            'commercial_partner_id' => 'Commercial Entity',
            'kmk' => 'KMK',
            'faktur_pajak_no' => 'Faktur Pajak',
            'kwitansi' => 'Kwitansi',
            'pajak' => 'Kurs Pajak',
            'kurs' => 'Kurs BI',
            'approver' => 'Approved by',
        ];
    }

   /* public function afterFind(){
        
        $this->amount_tax = $this->numberFormat($this->amount_tax);
        $this->amount_untaxed = $this->numberFormat($this->amount_untaxed);
        $this->amount_total = $this->numberFormat($this->amount_total);
        return true;
    }*/

    private function numberFormat($val){
        return number_format($val,2,',','.');
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceTaxes()
    {
        return $this->hasMany(AccountInvoiceTax::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprover0()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'approver']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(AccountPeriod::className(), ['id' => 'period_id']);
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
    public function getFiscalPosition()
    {
        return $this->hasOne(AccountFiscalPosition::className(), ['id' => 'fiscal_position']);
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
    public function getJournal()
    {
        return $this->hasOne(AccountJournal::className(), ['id' => 'journal_id']);
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
    public function getPartnerBank()
    {
        return $this->hasOne(ResPartnerBank::className(), ['id' => 'partner_bank_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentTerm()
    {
        return $this->hasOne(AccountPaymentTerm::className(), ['id' => 'payment_term']);
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
    public function getFakturAddress()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'faktur_address']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMove()
    {
        return $this->hasOne(AccountMove::className(), ['id' => 'move_id']);
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
    public function getAccountInvoiceLines()
    {
        return $this->hasMany(AccountInvoiceLine::className(), ['invoice_id' => 'id'])->orderBy('sequence, id ASC');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderInvoiceRels()
    {
        return $this->hasMany(SaleOrderInvoiceRel::className(), ['invoice_id' => 'id']);
    }

    public function getOrders(){
        return $this->hasMany(SaleOrder::className(),['id'=>'order_id'])->via('saleOrderInvoiceRels');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPickings()
    {
        return $this->hasMany(StockPicking::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseInvoiceRels()
    {
        return $this->hasMany(PurchaseInvoiceRel::className(), ['invoice_id' => 'id']);
    }

    public function afterFind(){
        $prtName = (isset($this->partner->parent) ? $this->partner->parent->name:$this->partner->name);
        $expPartnerName = explode(',',$prtName );
        if(is_array($expPartnerName) && isset($expPartnerName[1])){
            $this->partner_to_print = $expPartnerName[1].'. '.$expPartnerName[0];
        }else{
            $this->partner_to_print = $this->partner->name;
        }
    }
}
