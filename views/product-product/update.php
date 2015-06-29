<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductProduct */

$this->title = 'Update Product Product: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
