<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StockPicking */

$this->title = 'Create Stock Picking';
$this->params['breadcrumbs'][] = ['label' => 'Stock Pickings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-picking-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
