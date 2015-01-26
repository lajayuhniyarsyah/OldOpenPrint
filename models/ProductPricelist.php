<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_pricelist".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $currency_id
 * @property string $name
 * @property boolean $active
 * @property string $type
 * @property integer $company_id
 *
 * @property ProductPricelistItem[] $productPricelistItems
 * @property ProductPriceList[] $productPriceLists
 * @property ResUsers $writeU
 * @property ResCurrency $currency
 * @property ResUsers $createU
 * @property ResCompany $company
 * @property ProductPricelistVersion[] $productPricelistVersions
 * @property SaleShop[] $saleShops
 * @property SetPo[] $setPos
 * @property SaleOrder[] $saleOrders
 * @property WizardPoRent[] $wizardPoRents
 * @property PurchaseOrder[] $purchaseOrders
 */
class ProductPricelist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_pricelist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'currency_id', 'company_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['currency_id', 'name', 'type'], 'required'],
            [['active'], 'boolean'],
            [['type'], 'string'],
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
            'currency_id' => 'Currency ID',
            'name' => 'Name',
            'active' => 'Active',
            'type' => 'Type',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistItems()
    {
        return $this->hasMany(ProductPricelistItem::className(), ['base_pricelist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPriceLists()
    {
        return $this->hasMany(ProductPriceList::className(), ['price_list' => 'id']);
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
    public function getCurrency()
    {
        return $this->hasOne(ResCurrency::className(), ['id' => 'currency_id']);
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
    public function getCompany()
    {
        return $this->hasOne(ResCompany::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPricelistVersions()
    {
        return $this->hasMany(ProductPricelistVersion::className(), ['pricelist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleShops()
    {
        return $this->hasMany(SaleShop::className(), ['pricelist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetPos()
    {
        return $this->hasMany(SetPo::className(), ['pricelist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleOrders()
    {
        return $this->hasMany(SaleOrder::className(), ['pricelist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardPoRents()
    {
        return $this->hasMany(WizardPoRent::className(), ['pricelist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['pricelist_id' => 'id']);
    }
}
