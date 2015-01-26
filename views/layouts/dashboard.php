<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php $this->registerCssFile(yii\helpers\Url::base().'/css/openerp.css'); ?>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Open ERP Report</title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="openerp">
             <?php
                NavBar::begin([
                    // 'brandLabel' => 'Management Report',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top oe_topbar',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-left'],
                    'items' => [
                        ['label' => 'Dashboard', 'url' => ['/site/dashboard']],
                        ['label' => 'Sales', 'url' => ['#'],
                             'items'=> [
                                  ['label' => 'Sales Activity', 'url' => ['/site/activity']],
                                  ['label' => 'Weekly Status', 'url' => ['/site/weeklystatus']],
                                  ['label' => 'Executive Summary', 'url' => ['#']],
                                  ['label' => 'Rekap Invoice', 'url' => ['#']],
                                  ['label' => 'Sales Order', 'url' => ['#']],
                                ]
                        ],
                        ['label' => 'Admin', 'url' => ['/site/contact']],
                        ['label' => 'Accounting', 'url' => ['/site/contact']],
                        ['label' => 'Purchases', 'url' => ['/site/contact']],
                        ['label' => 'Warehouse', 'url' => ['/site/contact']],
                        ['label' => 'Manufacturing', 'url' => ['/site/contact']],
                        ['label' => 'Human Resources', 'url' => ['/site/contact']],
                        // Yii::$app->user->isGuest ?
                        //     ['label' => 'Login', 'url' => ['/site/login']] :
                        //     ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        //         'url' => ['/site/logout'],
                        //         'linkOptions' => ['data-method' => 'post']],
                    ],
                ]);
                NavBar::end();
            ?>  
    </div>
     
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
