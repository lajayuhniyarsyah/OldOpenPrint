<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StockPicking */

$this->title = 'Update Stock Picking: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stock Pickings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stock-picking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
