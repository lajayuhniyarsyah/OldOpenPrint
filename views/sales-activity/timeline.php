<?php
use yii\web\View;
use nirvana\infinitescroll\InfiniteScrollPager;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(['id'=>'pjaxListTimeLine','enablePushState'=>false,'enableReplaceState'=>false]); ?>
<?=\yii\widgets\ListView::widget([
	// 'id'=>'activityList',
	'dataProvider'=>$dataProvider,
	'layout' => "{summary}\n<div class=\"timeline items\">{items}</div>\n{pager}",
	'itemView'=>'timeLineItem',
	'itemOptions'=>[
		'tag'=>false,
	],
	'pager' => [
		'class' => \kop\y2sp\ScrollPager::className(),
		'eventOnScroll'=>'console.log(111)',
		'triggerOffset'=>3
	]
	
])?>
<?php Pjax::end(); ?>