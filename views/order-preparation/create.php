<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OrderPreparation */

$this->title = 'Create Order Preparation';
$this->params['breadcrumbs'][] = ['label' => 'Order Preparations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-preparation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
