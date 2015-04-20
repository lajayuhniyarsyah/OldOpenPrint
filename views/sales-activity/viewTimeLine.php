<?php
use yii\web\View;
use nirvana\infinitescroll\InfiniteScrollPager;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\bootstrap\Tabs;
use yii\bootstrap\BootstrapAsset;
?>

<?php
// View::registerCssFile('@web/css/bootsnip-timeline.css');
View::registerCssFile('@web/css/moTimeline.css',['depends'=>[BootstrapAsset::className()]]);


echo Tabs::widget([
	// 'renderTabContent'=>false,
    'items' => [
        [
            'label'		=> '<span class="glyphicon glyphicon-tasks"></span>',
            'encode'	=> false,
            // 'content'   => $this->render('timeline',['dataProvider'=>$dataProvider]),
            'content'   => $this->render('timeline2',['dataProvider'=>$dataProvider]),
        ],
        [
            'label'		=> '<span class="glyphicon glyphicon-stats"></span>',
            'encode'	=> false,
            'content'	=> $this->render('charts',['charts'=>$charts,'series'=>$series]),
            'active'	=> true
        ],
        [
            'label'		=> '<span class="glyphicon glyphicon-search"></span>',
            'encode'	=> false,
            'content'	=> $this->render('_search',['model'=>$salesActivityForm])
        ],
    ],
]);




?>

