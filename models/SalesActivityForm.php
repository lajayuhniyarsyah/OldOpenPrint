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
    public $from;
    public $to;
    public $type;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['sales', 'customer', 'from', 'to','type'], 'required'],
            // email has to be a valid email address
            // ['email', 'email'],
            
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'sales' => 'Sales',
            'customer'=>'Customer',
            'from'=>'from',
            'to'=>'to'
        ];
    }


}
