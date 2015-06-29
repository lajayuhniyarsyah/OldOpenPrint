<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductProduct */

$this->title = 'Create Product Product';
$this->params['breadcrumbs'][] = ['label' => 'Product Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
