<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SalesActivityForm extends Model
{
    public $sales;
    public $customer;
    public $date_begin;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['sales','customer','date_begin'],'safe'],
        ];
    }

    public function checkSalesArray(){
        return true;
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'sales' => 'Sales',
            'customer'=>'Customer',
            'date_begin'=>'Date',
        ];
    }


}
