<?php

namespace app\models;


use Yii;
use \NumberFormatter;
/**
 * This is the model class for table "account_invoice_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $origin
 * @property integer $uos_id
 * @property integer $account_id
 * @property string $name
 * @property integer $sequence
 * @property integer $invoice_id
 * @property string $price_unit
 * @property string $price_subtotal
 * @property integer $company_id
 * @property string $discount
 * @property integer $account_analytic_id
 * @property string $quantity
 * @property integer $partner_id
 * @property integer $product_id
 * @property integer $asset_category_id
 * @property integer $spk
 * @property double $amount_discount
 *
 * @property AccountInvoiceLineTax[] $accountInvoiceLineTaxes
 * @property PerintahKerja $spk0
 * @property AccountAssetCategory $assetCategory
 * @property ProductProduct $product
 * @property AccountAccount $account
 * @property AccountInvoice $invoice
 * @property ProductUom $uos
 * @property AccountAnalyticAccount $accountAnalytic
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property SaleOrderLineInvoiceRel[] $saleOrderLineInvoiceRels
 * @property PurchaseOrderLineInvoiceRel[] $purchaseOrderLineInvoiceRels
 */
class AccountInvoiceLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_invoice_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'uos_id', 'account_id', 'sequence', 'invoice_id', 'company_id', 'account_analytic_id', 'partner_id', 'product_id', 'asset_category_id', 'spk'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['account_id', 'name', 'price_unit', 'quantity'], 'required'],
            [['name'], 'string'],
            [['price_unit', 'price_subtotal', 'discount', 'quantity', 'amount_discount'], 'number'],
            [['origin'], 'string', 'max' => 256]
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
            'uos_id' => 'Unit of Measure',
            'account_id' => 'Account',
            'name' => 'Description',
            'sequence' => 'Sequence',
            'invoice_id' => 'Invoice Reference',
            'price_unit' => 'Unit Price',
            'price_subtotal' => 'Amount',
            'company_id' => 'Company',
            'discount' => 'Discount (%)',
            'account_analytic_id' => 'Analytic Account',
            'quantity' => 'Quantity',
            'partner_id' => 'Partner',
            'product_id' => 'Product',
            'asset_category_id' => 'Asset Category',
            'spk' => 'Work Order',
            'amount_discount' => 'Amount Discount',
        ];
    }


    public static function createQuery(){
        return parent::createQuery()->defaultOrder();
    }

    public static function defaultOrder($query){
        return $query->orderBy('no desc');
    }


    public function afterFind(){
        $this->price_subtotal = number_format($this->price_subtotal,2,',','.');
        // $this->price_subtotal = Yii::$app->formatter->asCurrency($this->price_subtotal,'',[],[NumberFormatter::DECIMAL_SEPARATOR_SYMBOL=>',']);

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountInvoiceLineTaxes()
    {
        return $this->hasMany(AccountInvoiceLineTax::className(), ['invoice_line_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpk0()
    {
        return $this->hasOne(PerintahKerja::className(), ['id' => 'spk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssetCategory()
    {
        return $this->hasOne(AccountAssetCategory::className(), ['id' => 'asset_category_id']);
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
    public function getAccount()
    {
        return $this->hasOne(AccountAccount::className(), ['id' => 'account_id']);
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
    public function getUos()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'uos_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrderLineInvoiceRels()
    {
        return $this->hasMany(SaleOrderLineInvoiceRel::className(), ['invoice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrderLineInvoiceRels()
    {
        return $this->hasMany(PurchaseOrderLineInvoiceRel::className(), ['invoice_id' => 'id']);
    }
}
