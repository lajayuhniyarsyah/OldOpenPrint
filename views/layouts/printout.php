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
    <style type="text/css">
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        @page {
            margin: 1%;
        }
        @media screen{
            #btnSetting{
                position: fixed;
                right: 0;
                top: 7px;
                z-index: 99;
                cursor: pointer;
            }
            #absoluteWrapper{
                top: 0;
                left: 0;
                position: fixed;
                display: none;
                background: black;
                width: 100%;
                height: 100%;
            }
            .hidden{
                display: none;
            }

        }
        @media print{
            .hideOnPrint{
                display: none;
            }
        }
    </style>
    <?php
        /*$this->registerJs('
            jQuery(\'#btnSetting\').click(function(){
                jQuery(\'#absoluteWrapper\').show();
                return false;
            });
        ',\yii\web\View::POS_HEAD);*/
    ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div>
        
        <div>
            <?= $content ?>
        </div>
    </div>

    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
