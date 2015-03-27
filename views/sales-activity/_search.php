<?php

use yii\helpers\Html;
use yii\helpers\Url;

use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;

use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model app\models\SalesActivitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => [''],
        'method' => 'get',
    ]);
    $saleGroup = \app\models\ResGroups::find()
        ->select('id')
        ->with(
            [
                'users',
                'users.partner'=>function($query){
                    $query->orderBy('name ASC');
                },

            ]
        )
        ->where(['name'=>'All Sales User'])->asArray()->one();
    
    $saleUsers = \yii\helpers\ArrayHelper::map($saleGroup['users'],'id','partner.name');
    // var_dump($saleGroup);
    ?>
    <div class="form-group">
        <label class="controll-label" for="sales">Sales</label>
        <?=Select2::widget([
            'model'=>$model,
            'attribute'=>'sales',
            // 'name' => 'sales',
            'data' => $saleUsers,
            'value'=>Yii::$app->request->get('sales'),
            'options' => [
                'placeholder' => 'Select Sales ...',
                // 'multiple' => true,
            ],
            'pluginOptions'=>[
                'allowClear'=>true,
            ]
        ]);?>
    </div>
    <div class="form-group">
        <label class="controll-label" for="customer">Customer</label>

        <?=Select2::widget([
            'model'=>$model,
            'attribute' => 'customer',
            // 'name' => 'customer',
            'value'=>$model->customer,
            'pluginOptions'=>[
                'ajax'=>[
                    'url'=>Url::to(['service/search-customer']),
                    'dataType'=>'json',
                    'data'=>new JsExpression('function(term,page){return {search:term}; }'),
                    'results'=>new JsExpression('function(data,page){ return {results:data.results}; }'),
                ],
                'allowClear'=>true,
                'initSelection' => new JsExpression('function (element, callback) {
                    var id=$(element).val();
                    if (id !== "") {
                        $.ajax("'.Url::to(['service/search-customer']).'?id=" + id, {
                            dataType: "json"
                            }).done(function(data) { 
                                callback(data.results);

                            }
                        );
                    }
                }'),
            ],
            'options' => [
                'placeholder' => 'Select Sales ...',
                
            ],
        ]);
        ?>
    </div>
    
    <div class="form-group">
    <?=DatePicker::widget([
        'model' => $model,
        'attribute' => 'date_begin',
        'options' => ['placeholder' => 'Start date'],
        'form' => $form,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd',
            'autoclose' => true,
            'startDate'=>'2014-07-01',
        ],
        'convertFormat'=>true,
    ]);?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
