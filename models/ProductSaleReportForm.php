<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ProductSaleReportForm extends Model
{
    public $partner;
    public $product;
    public $productcategory;
    public $date_from;
    public $date_to;
    public $state;
    public $pricelist;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['product','productcategory', 'partner','date_from','date_to','pricelist','state'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'product' => 'Product',
            'productcategory'=>'Product Category',
            'partner' => 'Partner',
            'date_from'=>'Date From',
            'date_to' => 'Date To',
            'pricelist'=>'Currecy',
            'state'=>'State'
        ];
    }

}

