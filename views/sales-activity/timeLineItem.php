<?php
use yii\helpers\Html;
?>
<li class="item timeline-<?=($model['daylight']==2 ? 'inverted':'badge')?>">
	<div class="timeline-badge <?=($model['not_planned_actual'] ? 'danger':'info')?>"><i class="glyphicon glyphicon-list-alt"></i></div>
	<div class="timeline-panel">
		<div class="timeline-heading row">
			<div class="col-xs-12 col-sm-6 col-md-8">
				<h4 class="timeline-title">
					<?=$model['user']['partner']['name']?>
				</h4>
				<div>
					<small><?=Html::encode(date('l, d-M-Y',strtotime($model['the_date'])))?></small>
					
				</div>
				
			</div>
		</div>
		<hr/>
		<div class="timeline-body">
			<!-- if not planned then dont render the plan row -->
			<?php 
			$to_actual = ($model['actualPartner']['name'] ?$model['actualPartner']['name'].' / ':null).$model['actual_location'];
			if(!$model['not_planned_actual']): ?>
			<dl class="<?=($model['canceled_plan'] ? 'text-danger':null)?>">

				<dt>
					Planned Go To <?=Html::encode(($model['partner']['name'] ?$model['partner']['name'].' / ':null).$model['location'])?>
						<?=($model['canceled_plan'] ? ' Was Canceled':null)?>
				</dt>
				<dd>
					<?=nl2br(Html::encode($model['name']))?>
					<br/>
				</dd>
			</dl>

			<?php endif; ?>

			<?php
			if($model['canceled_plan'] || trim($model['actual_result']) != ''):
				?>
				<?php if(!$model['not_planned_actual']) echo '<hr/>'; ?>
				<dl>
					<dt><?=($model['not_planned_actual'] ? 'Unplanned Task : Went To '.$to_actual:'Actual Result Went To '.$to_actual)?></dt>
					<dd>
						<?php
							echo nl2br(Html::encode($model['actual_result']));
							if($model['canceled_plan'] && trim($model['actual_result']) == ''){
								echo '<i class="text-warning small">Result is Not Set</i>';
							}
						?>
					</dd>
				</dl>
				<?php
			endif;
			?>
		</div>
	</div>
</li>