<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "account_account".
 *
 * @property integer $id
 * @property integer $parent_left
 * @property integer $parent_right
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $code
 * @property boolean $reconcile
 * @property integer $currency_id
 * @property integer $user_type
 * @property boolean $active
 * @property string $name
 * @property integer $level
 * @property integer $company_id
 * @property string $shortcut
 * @property string $note
 * @property integer $parent_id
 * @property string $currency_mode
 * @property string $type
 *
 * @property AccountAnalyticLine[] $accountAnalyticLines
 * @property AccountAddtmplWizard[] $accountAddtmplWizards
 * @property WizardSupplierFirstPayment[] $wizardSupplierFirstPayments
 * @property AccountCommonJournalReport[] $accountCommonJournalReports
 * @property AccountCommonPartnerReport[] $accountCommonPartnerReports
 * @property AccountMoveLineUnreconcileSelect[] $accountMoveLineUnreconcileSelects
 * @property AccountMoveLineReconcileSelect[] $accountMoveLineReconcileSelects
 * @property AccountMoveLineReconcileWriteoff[] $accountMoveLineReconcileWriteoffs
 * @property AccountFiscalPositionAccount[] $accountFiscalPositionAccounts
 * @property AccountAccountConsolRel[] $accountAccountConsolRels
 * @property AccountAccountTypeRel[] $accountAccountTypeRels
 * @property AccountAccountTaxDefaultRel[] $accountAccountTaxDefaultRels
 * @property AccountAccountFinancialReport[] $accountAccountFinancialReports
 * @property AccountTax[] $accountTaxes
 * @property AccountAccountType $userType
 * @property ResCurrency $currency
 * @property AccountAccount $parent
 * @property AccountAccount[] $accountAccounts
 * @property ResCompany $company
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property AccountModelLine[] $accountModelLines
 * @property AccountJournal[] $accountJournals
 * @property AccountInvoiceTax[] $accountInvoiceTaxes
 * @property AccountCommonAccountReport[] $accountCommonAccountReports
 * @property ReconcileAccountRel[] $reconcileAccountRels
 * @property AccountAutomaticReconcile[] $accountAutomaticReconciles
 * @property AccountCommonReport[] $accountCommonReports
 * @property AccountInvoice[] $accountInvoices
 * @property AccountPartnerBalance[] $accountPartnerBalances
 * @property AccountInvoiceLine[] $accountInvoiceLines
 * @property AccountBankStatementLine[] $accountBankStatementLines
 * @property AccountPartnerLedger[] $accountPartnerLedgers
 * @property AccountAgedTrialBalance[] $accountAgedTrialBalances
 * @property AccountVatDeclaration[] $accountVatDeclarations
 * @property AccountGeneralJournal[] $accountGeneralJournals
 * @property AccountCentralJournal[] $accountCentralJournals
 * @property AccountVoucherLine[] $accountVoucherLines
 * @property AccountVoucher[] $accountVouchers
 * @property StockChangeStandardPrice[] $stockChangeStandardPrices
 * @property MrpWorkcenter[] $mrpWorkcenters
 * @property AccountAssetCategory[] $accountAssetCategories
 * @property MutasiAccount[] $mutasiAccounts
 * @property ResCompany[] $resCompanies
 * @property AccountingReport[] $accountingReports
 * @property AccountPrintJournal[] $accountPrintJournals
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountBalanceReport[] $accountBalanceReports
 * @property AccountReportGeneralLedger[] $accountReportGeneralLedgers
 * @property StockLocation[] $stockLocations
 */
class AccountAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_left', 'parent_right', 'create_uid', 'write_uid', 'currency_id', 'user_type', 'level', 'company_id', 'parent_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['code', 'user_type', 'name', 'company_id', 'currency_mode', 'type'], 'required'],
            [['reconcile', 'active'], 'boolean'],
            [['note', 'currency_mode', 'type'], 'string'],
            [['code'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 256],
            [['shortcut'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_left' => 'Parent Left',
            'parent_right' => 'Parent Right',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'code' => 'Code',
            'reconcile' => 'Reconcile',
            'currency_id' => 'Currency ID',
            'user_type' => 'User Type',
            'active' => 'Active',
            'name' => 'Name',
            'level' => 'Level',
            'company_id' => 'Company ID',
            'shortcut' => 'Shortcut',
            'note' => 'Note',
            'parent_id' => 'Parent ID',
            'currency_mode' => 'Currency Mode',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAnalyticLines()
    {
        return $this->hasMany(AccountAnalyticLine::className(), ['general_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAddtmplWizards()
    {
        return $this->hasMany(AccountAddtmplWizard::className(), ['cparent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardSupplierFirstPayments()
    {
        return $this->hasMany(WizardSupplierFirstPayment::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonJournalReports()
    {
        return $this->hasMany(AccountCommonJournalReport::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonPartnerReports()
    {
        return $this->hasMany(AccountCommonPartnerReport::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineUnreconcileSelects()
    {
        return $this->hasMany(AccountMoveLineUnreconcileSelect::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconcileSelects()
    {
        return $this->hasMany(AccountMoveLineReconcileSelect::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLineReconcileWriteoffs()
    {
        return $this->hasMany(AccountMoveLineReconcileWriteoff::className(), ['writeoff_acc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountFiscalPositionAccounts()
    {
        return $this->hasMany(AccountFiscalPositionAccount::className(), ['account_dest_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountConsolRels()
    {
        return $this->hasMany(AccountAccountConsolRel::className(), ['child_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTypeRels()
    {
        return $this->hasMany(AccountAccountTypeRel::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTaxDefaultRels()
    {
        return $this->hasMany(AccountAccountTaxDefaultRel::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountFinancialReports()
    {
        return $this->hasMany(AccountAccountFinancialReport::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountTaxes()
    {
        return $this->hasMany(AccountTax::className(), ['account_paid_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserType()
    {
        return $this->hasOne(AccountAccountType::className(), ['id' => 'user_type']);
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
    public function getParent()
    {
        return $this->hasOne(AccountAccount::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccounts()
    {
        return $this->hasMany(AccountAccount::className(), ['parent_id' => 'id']);
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
    public function getAccountModelLines()
    {
        return $this->hasMany(AccountModelLine::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountJournals()
    {
        return $this->hasMany(AccountJournal::className(), ['default_debit_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceTaxes()
    {
        return $this->hasMany(AccountInvoiceTax::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonAccountReports()
    {
        return $this->hasMany(AccountCommonAccountReport::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReconcileAccountRels()
    {
        return $this->hasMany(ReconcileAccountRel::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAutomaticReconciles()
    {
        return $this->hasMany(AccountAutomaticReconcile::className(), ['writeoff_acc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCommonReports()
    {
        return $this->hasMany(AccountCommonReport::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoices()
    {
        return $this->hasMany(AccountInvoice::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerBalances()
    {
        return $this->hasMany(AccountPartnerBalance::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLines()
    {
        return $this->hasMany(AccountInvoiceLine::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankStatementLines()
    {
        return $this->hasMany(AccountBankStatementLine::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPartnerLedgers()
    {
        return $this->hasMany(AccountPartnerLedger::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAgedTrialBalances()
    {
        return $this->hasMany(AccountAgedTrialBalance::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVatDeclarations()
    {
        return $this->hasMany(AccountVatDeclaration::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountGeneralJournals()
    {
        return $this->hasMany(AccountGeneralJournal::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountCentralJournals()
    {
        return $this->hasMany(AccountCentralJournal::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVoucherLines()
    {
        return $this->hasMany(AccountVoucherLine::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVouchers()
    {
        return $this->hasMany(AccountVoucher::className(), ['writeoff_acc_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockChangeStandardPrices()
    {
        return $this->hasMany(StockChangeStandardPrice::className(), ['stock_account_input' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrpWorkcenters()
    {
        return $this->hasMany(MrpWorkcenter::className(), ['costs_general_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetCategories()
    {
        return $this->hasMany(AccountAssetCategory::className(), ['account_expense_depreciation_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMutasiAccounts()
    {
        return $this->hasMany(MutasiAccount::className(), ['account_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCompanies()
    {
        return $this->hasMany(ResCompany::className(), ['expense_currency_exchange_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountingReports()
    {
        return $this->hasMany(AccountingReport::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPrintJournals()
    {
        return $this->hasMany(AccountPrintJournal::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines()
    {
        return $this->hasMany(AccountMoveLine::className(), ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBalanceReports()
    {
        return $this->hasMany(AccountBalanceReport::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountReportGeneralLedgers()
    {
        return $this->hasMany(AccountReportGeneralLedger::className(), ['chart_account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockLocations()
    {
        return $this->hasMany(StockLocation::className(), ['valuation_out_account_id' => 'id']);
    }
}
