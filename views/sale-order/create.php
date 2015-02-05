<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SaleOrder */

$this->title = 'Create Sale Order';
$this->params['breadcrumbs'][] = ['label' => 'Sale Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
