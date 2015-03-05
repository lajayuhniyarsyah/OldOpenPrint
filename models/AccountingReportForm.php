<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class AccountingReportForm extends Model
{
    public $account;
    public $partner;
    public $date_from;
    public $date_to;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['date_from'], 'required'],
            [['account', 'partner','date_from','date_to'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'account' => 'Account',
            'partner' => 'Partner',
            'date_from'=>'Date From',
            'date_to' => 'Date To'
        ];
    }

}

