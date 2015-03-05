<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class WeeklyStatusForm extends Model
{
    public $sales;
    public $customer;
    public $status;
    public $productgroup;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            // [['sales', 'customer'], 'required'],
            [['sales', 'customer','status','productgroup'], 'safe'],
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
            'status'=>'Status',
            'productgroup'=>'Product Group'
        ];
    }



}
