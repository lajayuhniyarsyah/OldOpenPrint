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
            [['date_from','date_to'],'safe'],
            [['sales'],'checkSales'],
        ];
    }

    public function checkSales($attribute,$params){
        // var_dump($salesId);
        foreach($this->$attribute as $salesId){
            // validate must be a number
            $validator = new \yii\validators\NumberValidator();
            if($validator->validate($salesId,$error)){
                $query = new \yii\db\Query;
                $query->select('id')
                    ->from(ResUsers::tableName())
                    ->where('id = :salesIds')
                    ->addParams([':salesIds'=>$salesId]);
                if(!$query->exists()){
                    $this->addError($attribute,'Sales Man did you search is not exist for sales man id '.$salesId);
                }
            }else{
                $this->addError($attribute,'Sales Man did u search is not valid');
            }
            

        }
    }
}
