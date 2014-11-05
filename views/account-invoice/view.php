<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AccountInvoice */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Account Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-invoice-view">

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
        <?= Html::a('Update', ['print', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'create_uid',
            'create_date',
            'write_date',
            'write_uid',
            'origin',
            'date_due',
            'check_total',
            'reference',
            'supplier_invoice_number',
            'number',
            'account_id',
            'company_id',
            'currency_id',
            'partner_id',
            'fiscal_position',
            'user_id',
            'partner_bank_id',
            'payment_term',
            'reference_type',
            'journal_id',
            'amount_tax',
            'state',
            'type',
            'internal_number',
            'reconciled:boolean',
            'residual',
            'move_name',
            'date_invoice',
            'period_id',
            'amount_untaxed',
            'move_id',
            'amount_total',
            'name',
            'comment:ntext',
            'sent:boolean',
            'commercial_partner_id',
            'kmk',
            'faktur_pajak_no',
            'kwitansi',
            'pajak',
            'kurs',
            'approver',
        ],
    ]) ?>

</div>
