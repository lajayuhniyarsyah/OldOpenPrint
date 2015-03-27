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
            // name, email, subject and body are required
            // [['sales', 'customer'], 'required'],
            [['sales', 'customer','date_begin'], 'safe'],
            [['sales', 'customer'],'number','integerOnly'=>true,]
            // email has to be a valid email address
            // ['email', 'email'],
            
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
