<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResPartner */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Res Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="res-partner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'lang',
            'company_id',
            'create_uid',
            'create_date',
            'write_date',
            'write_uid',
            'comment:ntext',
            'ean13',
            'color',
            'image',
            'use_parent_address:boolean',
            'active:boolean',
            'street',
            'supplier:boolean',
            'city',
            'user_id',
            'zip',
            'title',
            'function',
            'country_id',
            'parent_id',
            'employee:boolean',
            'type',
            'email:email',
            'vat',
            'website',
            'fax',
            'street2',
            'phone',
            'credit_limit',
            'date',
            'tz',
            'customer:boolean',
            'image_medium',
            'mobile',
            'ref',
            'image_small',
            'birthdate',
            'is_company:boolean',
            'state_id',
            'notification_email_send:email',
            'opt_out:boolean',
            'signup_type',
            'signup_expiration',
            'signup_token',
            'last_reconciliation_date',
            'debit_limit',
            'display_name',
            'npwp',
            'term_payment:ntext',
        ],
    ]) ?>

</div>
