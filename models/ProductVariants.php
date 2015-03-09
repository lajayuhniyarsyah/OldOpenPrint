<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_variants".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $product_id
 * @property integer $satuan
 * @property string $name
 *
 * @property WizardDetailPb[] $wizardDetailPbs
 * @property DetailPb[] $detailPbs
 * @property ProductUom $satuan0
 * @property ProductProduct $product
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property PurchaseOrderLine[] $purchaseOrderLines
 */
class ProductVariants extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_variants';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'product_id', 'satuan'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['name'], 'string']
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
            'product_id' => 'Product ID',
            'satuan' => 'Satuan',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardDetailPbs()
    {
        return $this->hasMany(WizardDetailPb::className(), ['variants' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailPbs()
    {
        return $this->hasMany(DetailPb::className(), ['variants' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan0()
    {
        return $this->hasOne(ProductUom::className(), ['id' => 'satuan']);
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
    public function getPurchaseOrderLines()
    {
        return $this->hasMany(PurchaseOrderLine::className(), ['variants' => 'id']);
    }
}
