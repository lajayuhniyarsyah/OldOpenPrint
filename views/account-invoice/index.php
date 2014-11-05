<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccountInvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Account Invoices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-invoice-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Account Invoice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'create_uid',
            'create_date',
            'write_date',
            'write_uid',
            // 'origin',
            // 'date_due',
            // 'check_total',
            // 'reference',
            // 'supplier_invoice_number',
            // 'number',
            // 'account_id',
            // 'company_id',
            // 'currency_id',
            // 'partner_id',
            // 'fiscal_position',
            // 'user_id',
            // 'partner_bank_id',
            // 'payment_term',
            // 'reference_type',
            // 'journal_id',
            // 'amount_tax',
            // 'state',
            // 'type',
            // 'internal_number',
            // 'reconciled:boolean',
            // 'residual',
            // 'move_name',
            // 'date_invoice',
            // 'period_id',
            // 'amount_untaxed',
            // 'move_id',
            // 'amount_total',
            // 'name',
            // 'comment:ntext',
            // 'sent:boolean',
            // 'commercial_partner_id',
            // 'kmk',
            // 'faktur_pajak_no',
            // 'kwitansi',
            // 'pajak',
            // 'kurs',
            // 'approver',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
