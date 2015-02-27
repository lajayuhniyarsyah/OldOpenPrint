<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalesActivity */

$this->title = 'Update Sales Activity: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sales Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
