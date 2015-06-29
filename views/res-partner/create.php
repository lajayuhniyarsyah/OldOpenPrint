<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ResPartner */

$this->title = 'Create Res Partner';
$this->params['breadcrumbs'][] = ['label' => 'Res Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="res-partner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
