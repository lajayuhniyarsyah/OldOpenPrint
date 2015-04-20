<?php
use yii\web\View;
// use nirvana\infinitescroll\InfiniteScrollPager;
use yii\widgets\Pjax;
use yii\bootstrap\BootstrapAsset;
?>

<?php Pjax::begin(['id'=>'pjaxListTimeLine','enablePushState'=>false,'enableReplaceState'=>false]); ?>
<?php
echo \yii\widgets\ListView::widget([
	// 'id'=>'activityList',
	'dataProvider'=>$dataProvider,
	'layout' => "{summary}\n<ul class=\"timeline\">{items}<li class=\"item clearfix\" style=\"float: none;\"></li></ul>\n{pager}",
	'itemView'=>'timeLineItem2',
	'itemOptions'=>[
		'tag'=>false,
	],
	'pager' => [
		'class' => \kop\y2sp\ScrollPager::className(),
		/*'eventOnScroll'=>'console.log(\'scrolled\')',
		'triggerOffset'=>2,*/
	]	
])
?>
<!-- <ul class="timeline">
    <li>
      <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
      <div class="timeline-panel">
        <div class="timeline-heading">
          <img class="img-responsive" src="http://lorempixel.com/1600/500/sports/2" />
          
        </div>
        <div class="timeline-body">
          <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
          
        </div>
        
        <div class="timeline-footer">
            <a><i class="glyphicon glyphicon-thumbs-up"></i></a>
            <a><i class="glyphicon glyphicon-share"></i></a>
            <a class="pull-right">Continuar Lendo</a>
        </div>
      </div>
    </li>
    
    <li  class="timeline-inverted">
      <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record invert" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
      <div class="timeline-panel">
        <div class="timeline-heading">
          <img class="img-responsive" src="http://lorempixel.com/1600/500/sports/2" />
          
        </div>
        <div class="timeline-body">
          <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
         
        </div>
        
        <div class="timeline-footer">
            <a><i class="glyphicon glyphicon-thumbs-up"></i></a>
            <a><i class="glyphicon glyphicon-share"></i></a>
            <a class="pull-right">Continuar Lendo</a>
        </div>
      </div>
    </li>
    <li>
      <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
      <div class="timeline-panel">
        <div class="timeline-heading">
          <img class="img-responsive" src="http://lorempixel.com/1600/500/sports/2" />
          
        </div>
        <div class="timeline-body">
          <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
          
        </div>
        
        <div class="timeline-footer">
            <a><i class="glyphicon glyphicon-thumbs-up"></i></a>
            <a><i class="glyphicon glyphicon-share"></i></a>
            <a class="pull-right">Continuar Lendo</a>
        </div>
      </div>
    </li>
    
    <li  class="timeline-inverted">
      <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record invert" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
      <div class="timeline-panel">
        <div class="timeline-body">
          <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
          
        </div>
        
        <div class="timeline-footer">
            <a><i class="glyphicon glyphicon-thumbs-up"></i></a>
            <a><i class="glyphicon glyphicon-share"></i></a>
            <a class="pull-right">Continuar Lendo</a>
        </div>
      </div>
    </li>
    <li>
      <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
      <div class="timeline-panel">
        <div class="timeline-heading">
          <img class="img-responsive" src="http://lorempixel.com/1600/500/sports/2" />
          
        </div>
        <div class="timeline-body">
          <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
          
        </div>
        
        <div class="timeline-footer">
            <a><i class="glyphicon glyphicon-thumbs-up"></i></a>
            <a><i class="glyphicon glyphicon-share"></i></a>
            <a class="pull-right">Continuar Lendo</a>
        </div>
      </div>
    </li>
    
    <li  class="timeline-inverted">
      <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record invert" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
      <div class="timeline-panel">
        <div class="timeline-heading">
          <img class="img-responsive" src="http://lorempixel.com/1600/500/sports/2" />
          
        </div>
        <div class="timeline-body">
          <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
          
        </div>
        
        <div class="timeline-footer primary">
            <a><i class="glyphicon glyphicon-thumbs-up"></i></a>
            <a><i class="glyphicon glyphicon-share"></i></a>
            <a class="pull-right">Continuar Lendo</a>
        </div>
      </div>
    </li>
    <li>
      <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record invert" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
      <div class="timeline-panel">
        <div class="timeline-body">
          <p><b>All the credits go to <a href="http://bootsnipp.com/rafamaciel">Rafamaciel</a></b></p>
          <p>I only make it responsive and remove the empty spaces to be more like Facebook timeline!</p>
        </div>
        
        <div class="timeline-footer primary">
            <a><i class="glyphicon glyphicon-thumbs-up"></i></a>
            <a><i class="glyphicon glyphicon-share"></i></a>
            <a class="pull-right">Continuar Lendo</a>
        </div>
      </div>
    </li>
    
    <li class="clearfix" style="float: none;"></li>
</ul> -->
<?php Pjax::end(); ?>