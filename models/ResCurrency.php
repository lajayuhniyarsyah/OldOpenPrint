<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "res_currency".
 *
 * @property integer $id
 * @property string $name
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $rounding
 * @property string $symbol
 * @property string $date
 * @property boolean $base
 * @property boolean $active
 * @property integer $accuracy
 * @property string $rating
 * @property string $position
 *
 * @property ResCurrencyRate[] $resCurrencyRates
 * @property ProductPricelist[] $productPricelists
 * @property ProductPriceType[] $productPriceTypes
 * @property StockPartialMoveLine[] $stockPartialMoveLines
 * @property StockPartialPickingLine[] $stockPartialPickingLines
 * @property WizardMultiChartsAccounts[] $wizardMultiChartsAccounts
 * @property AccountBankAccountsWizard[] $accountBankAccountsWizards
 * @property AccountChangeCurrency[] $accountChangeCurrencies
 * @property AccountInvoice[] $accountInvoices
 * @property AccountModelLine[] $accountModelLines
 * @property AccountAssetAsset[] $accountAssetAssets
 * @property AccountAccountTemplate[] $accountAccountTemplates
 * @property AccountMoveLine[] $accountMoveLines
 * @property AccountAccount[] $accountAccounts
 * @property ResCountry[] $resCountries
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property AccountJournal[] $accountJournals
 * @property AccountVoucher[] $accountVouchers
 * @property HrExpenseExpense[] $hrExpenseExpenses
 * @property ResCompany[] $resCompanies
 * @property WeekStatusLine[] $weekStatusLines
 * @property StockMove[] $stockMoves
 * @property RemainderSalesman[] $remainderSalesmen
 */
class ResCurrency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_uid', 'write_uid', 'accuracy'], 'integer'],
            [['create_date', 'write_date', 'date'], 'safe'],
            [['rounding', 'rating'], 'number'],
            [['base', 'active'], 'boolean'],
            [['position'], 'string'],
            [['name'], 'string', 'max' => 32],
            [['symbol'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'rounding' => 'Rounding Factor',
            'symbol' => 'Symbol',
            'date' => 'Date',
            'base' => 'Base',
            'active' => 'Active',
            'accuracy' => 'Computational Accuracy',
            'rating' => 'Rating',
            'position' => 'Symbol Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCurrencyRates()
    {
        return $this->hasMany(ResCurrencyRate::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelists()
    {
        return $this->hasMany(ProductPricelist::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPriceTypes()
    {
        return $this->hasMany(ProductPriceType::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialMoveLines()
    {
        return $this->hasMany(StockPartialMoveLine::className(), ['currency' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockPartialPickingLines()
    {
        return $this->hasMany(StockPartialPickingLine::className(), ['currency' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardMultiChartsAccounts()
    {
        return $this->hasMany(WizardMultiChartsAccounts::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountBankAccountsWizards()
    {
        return $this->hasMany(AccountBankAccountsWizard::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountChangeCurrencies()
    {
        return $this->hasMany(AccountChangeCurrency::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoices()
    {
        return $this->hasMany(AccountInvoice::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountModelLines()
    {
        return $this->hasMany(AccountModelLine::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAssetAssets()
    {
        return $this->hasMany(AccountAssetAsset::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccountTemplates()
    {
        return $this->hasMany(AccountAccountTemplate::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountMoveLines()
    {
        return $this->hasMany(AccountMoveLine::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountAccounts()
    {
        return $this->hasMany(AccountAccount::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCountries()
    {
        return $this->hasMany(ResCountry::className(), ['currency_id' => 'id']);
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
    public function getAccountJournals()
    {
        return $this->hasMany(AccountJournal::className(), ['currency' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountVouchers()
    {
        return $this->hasMany(AccountVoucher::className(), ['payment_rate_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHrExpenseExpenses()
    {
        return $this->hasMany(HrExpenseExpense::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResCompanies()
    {
        return $this->hasMany(ResCompany::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekStatusLines()
    {
        return $this->hasMany(WeekStatusLine::className(), ['currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMoves()
    {
        return $this->hasMany(StockMove::className(), ['price_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRemainderSalesmen()
    {
        return $this->hasMany(RemainderSalesman::className(), ['currency_id' => 'id']);
    }
}
