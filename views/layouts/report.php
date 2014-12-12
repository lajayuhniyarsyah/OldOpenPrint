<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

// AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php $this->registerJsFile(yii\helpers\Url::base().'/js/ckeditor/ckeditor.js',['position'=>\yii\web\View::POS_HEAD]); ?>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<style type="text/css">
    .ReportTable {
        margin:0px;padding:0px;
        width:100%;
        border:1px solid #666464;
        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;
        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;
        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;
        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
        border-collapse: collapse;
    }.ReportTable table{
        border-collapse: collapse;
        border-spacing: 0;
        width:100%;
        height:100%;
        margin:0px;padding:0px;
    }.ReportTable tr:last-child td:last-child {
        -moz-border-radius-bottomright:0px;
        -webkit-border-bottom-right-radius:0px;
        border-bottom-right-radius:0px;
    }
    .ReportTable table tr:first-child td:first-child {
        -moz-border-radius-topleft:0px;
        -webkit-border-top-left-radius:0px;
        border-top-left-radius:0px;
    }
    .ReportTable table tr:first-child td:last-child {
        -moz-border-radius-topright:0px;
        -webkit-border-top-right-radius:0px;
        border-top-right-radius:0px;
    }.ReportTable tr:last-child td:first-child{
        -moz-border-radius-bottomleft:0px;
        -webkit-border-bottom-left-radius:0px;
        border-bottom-left-radius:0px;
    }.ReportTable tr:hover td{
        background-color:#ffffff;
            

    }
    .ReportTable td{
        vertical-align:middle;
        
        background-color:#e5e5e5;

        border:1px solid #666464;
        border-width:0px 1px 1px 0px;
        text-align:left;
        padding:8px;
        font-size:9px;
        font-family:Arial;
        font-weight:normal;
        color:#000000;
    }.ReportTable tr:last-child td{
        border-width:0px 1px 0px 0px;
    }.ReportTable tr td:last-child{
        border-width:0px 0px 1px 0px;
    }.ReportTable tr:last-child td:last-child{
        border-width:0px 0px 0px 0px;
    }
    .ReportTable tr:first-child td{
            background:-o-linear-gradient(bottom, #cccccc 5%, #b2b2b2 100%);    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #b2b2b2) );
        background:-moz-linear-gradient( center top, #cccccc 5%, #b2b2b2 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#b2b2b2");  background: -o-linear-gradient(top,#cccccc,b2b2b2);

        background-color:#cccccc;
        border:0px solid #666464;
        text-align:center;
        border-width:0px 0px 1px 1px;
        font-size:11px;
        font-family:Arial;
        font-weight:bold;
        color:#000000;
    }
    .ReportTable tr:first-child:hover td{
        background:-o-linear-gradient(bottom, #cccccc 5%, #b2b2b2 100%);    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #cccccc), color-stop(1, #b2b2b2) );
        background:-moz-linear-gradient( center top, #cccccc 5%, #b2b2b2 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#cccccc", endColorstr="#b2b2b2");  background: -o-linear-gradient(top,#cccccc,b2b2b2);

        background-color:#cccccc;
    }
    .ReportTable tr:first-child td:first-child{
        border-width:0px 0px 1px 0px;
    }
    .ReportTable tr:first-child td:last-child{
        border-width:0px 0px 1px 1px;
    }
    .judul{
        color: black;
        font-family: Tahoma Bold,sans-serif;
        font-size: 25px;
        font-weight: bold;
        display: block;
        text-align: center;
    }
    .periode{
        color: black;
        font-family: Tahoma Bold,sans-serif;
        font-size: 15px;
        font-weight: bold;
        display: block;
        text-align: center;
    }
</style>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
