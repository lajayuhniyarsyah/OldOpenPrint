<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MrpBom */

$this->title = 'Create Mrp Bom';
$this->params['breadcrumbs'][] = ['label' => 'Mrp Boms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrp-bom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
