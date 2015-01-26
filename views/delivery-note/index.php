<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeliveryNoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Delivery Notes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-note-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Delivery Note', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'create_uid',
            'create_date',
            'write_date',
            'write_uid',
            // 'colorcode',
            // 'partner_id',
            // 'poc',
            // 'name',
            // 'partner_shipping_id',
            // 'note:ntext',
            // 'state',
            // 'tanggal',
            // 'prepare_id',
            // 'ekspedisi',
            // 'jumlah_coli',
            // 'terms:ntext',
            // 'special:boolean',
            // 'work_order_id',
            // 'work_order_in',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
