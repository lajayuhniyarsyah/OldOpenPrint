<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResPartner */

$this->title = 'Update Res Partner: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Res Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="res-partner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
