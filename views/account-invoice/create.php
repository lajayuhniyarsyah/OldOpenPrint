<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccountInvoice */

$this->title = 'Create Account Invoice';
$this->params['breadcrumbs'][] = ['label' => 'Account Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-invoice-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
