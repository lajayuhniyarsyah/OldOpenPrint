<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Sale Anual Report is the model behind the Sale Annual Report Form.
 */
class OrderInvoiceReportForm extends Model
{
    public $customer;
    public $sales;
    public $date_from;
    public $date_to;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['date_from','date_to'], 'required'],
        ];
    }
}
