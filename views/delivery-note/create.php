<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeliveryNote */

$this->title = 'Create Delivery Note';
$this->params['breadcrumbs'][] = ['label' => 'Delivery Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-note-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
