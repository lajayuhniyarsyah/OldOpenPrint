<?php

namespace app\controllers;

use Yii;
use app\models\SaleOrder;
use app\models\SaleOrderSearch;
use app\models\ResUsers;
use app\models\ResPartner;

use app\models\SaleAnnualReportForm;
use app\models\ResGroups;
use app\models\ResGroupsUsersRel;
use app\models\GroupSales;
use app\models\GroupSalesLine;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;

/**
 * SaleOrderController implements the CRUD actions for SaleOrder model.
 */
class SaleOrderController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
			'access'=>[
				'class'=>\yii\filters\AccessControl::className(),
				'rules'=>[
					[
						'allow'=>true,
						'roles'=>['@']
					],
					[
						'allow'=>false,
						'roles'=>['?']
					]
				]
			]
		];
	}
	/**
	 * Get User who in Management User Group
	 * @return Has Many Rel ResUsers of ResGroups
	 */
	private function getTrackOrderManagementUsers(){
		return \yii\helpers\ArrayHelper::map(ResGroups::find()->where(['name'=>'Management'])->one()->users,'id','login');
	}
	/**
	 * Lists all SaleOrder models.
	 * @return mixed
	 */
	public function actionIndex($uid)
	{
		$manageUsers = $this->getTrackOrderManagementUsers();
		$onlyShowByCreateUid = true;
		if(isset($manageUsers[$uid])){
			$onlyShowByCreateUid = false;
		}
		
		$searchModel = new SaleOrderSearch();
		
		$dataProvider = $searchModel->searchTrack(Yii::$app->request->queryParams,$uid,$onlyShowByCreateUid);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single SaleOrder model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new SaleOrder model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new SaleOrder();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing SaleOrder model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing SaleOrder model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	public function actionSalesAchievement()
	{
		$connection = \Yii::$app->db;
		$model = new SaleAnnualReportForm();
		$saleGroup = ResGroups::findOne(['name'=>'All Sales User']);
		$saleUsers = ArrayHelper::map($saleGroup->users,'id','name');


		$allOrderTitle = "Globally Orders Received";
		$dateQuery = "so.date_order > '2014-07-01'";
		$submited = false;
		if($model->load(Yii::$app->request->get())){
			$submited = true;
			if($model->date_from == $model->date_to){
				$dateQuery = "so.date_order = '{$model->date_from}'";
			}
			else{
				$dateQuery = "so.date_order BETWEEN '{$model->date_from}' AND '{$model->date_to}'";
			}
		}
		

		/*$queryAllOrder = <<< EOQ
SELECT 
	CAST(EXTRACT(YEAR FROM "date_order") AS INTEGER) AS period_year,
	CAST(EXTRACT(MONTH FROM "date_order") AS INTEGER) AS period_month,
	CONCAT(TO_CHAR(TO_TIMESTAMP (CAST(EXTRACT(MONTH FROM "date_order") AS TEXT), 'MM'), 'TMmon'), '-',CAST(EXTRACT(YEAR FROM "date_order") AS TEXT)) as month_name,
	SUM(so_rates.rates) AS subtotal
	FROM(
	select 
		so.*,
		(case when rcr.rating is null then(
			(
				case when 
					(case when rcr.rating is null and rc.id=13 then 1 else case when rcr.rating is null then 0 end end) = 0
				then 
					(select rating from res_currency_rate where currency_id=rc.id and name < so.date_order order by name desc limit 1) * amount_total
					
				else 
					(1*amount_total)
				end
			)
		)
		else
			(rcr.rating*amount_total)
		end) as rates
	from 
		sale_order as so
	join product_pricelist as ppr on so.pricelist_id = ppr.id
	join res_currency as rc on ppr.currency_id=rc.id
	left outer join res_currency_rate as rcr on rcr.currency_id=rc.id and rcr.name = so.date_order
	where 
		{$dateQuery}
		and
		so.state not in ('draft','cancel')
	order by so.date_order asc) AS so_rates
GROUP BY period_year, period_month, month_name
ORDER BY period_year ASC, period_month ASC
EOQ;*/


$queryAllOrder = <<< EOQ
SELECT 
	CAST(EXTRACT(YEAR FROM "date_order") AS INTEGER) AS period_year,
	CAST(EXTRACT(MONTH FROM "date_order") AS INTEGER) AS period_month,
	CONCAT(TO_CHAR(TO_TIMESTAMP (CAST(EXTRACT(MONTH FROM "date_order") AS TEXT), 'MM'), 'TMmon'), '-',CAST(EXTRACT(YEAR FROM "date_order") AS TEXT)) as month_name,
	SUM( CASE WHEN week=1 THEN so_rates.rates ELSE 0 END) AS subtotal_week_1,
	SUM( CASE WHEN week=2 THEN so_rates.rates ELSE 0 END) AS subtotal_week_2,
	SUM( CASE WHEN week=3 THEN so_rates.rates ELSE 0 END) AS subtotal_week_3,
	SUM( CASE WHEN week=4 THEN so_rates.rates ELSE 0 END) AS subtotal_week_4,
	SUM( CASE WHEN week=5 THEN so_rates.rates ELSE 0 END) AS subtotal_week_5,
	SUM(so_rates.rates) AS subtotal
	FROM(
	select 
		so.*,
		(case when rcr.rating is null then(
			(
				case when 
					(case when rcr.rating is null and rc.id=13 then 1 else case when rcr.rating is null then 0 end end) = 0
				then 
					(select rating from res_currency_rate where currency_id=rc.id and name < so.date_order order by name desc limit 1) * amount_total
					
				else 
					(1*amount_total)
				end
			)
		)
		else
			(rcr.rating*amount_total)
		end) as rates
	from 
		sale_order as so
	join product_pricelist as ppr on so.pricelist_id = ppr.id
	join res_currency as rc on ppr.currency_id=rc.id
	left outer join res_currency_rate as rcr on rcr.currency_id=rc.id and rcr.name = so.date_order
	where 
		{$dateQuery}
		and
		so.state not in ('draft','cancel')
	order by so.date_order asc) AS so_rates
GROUP BY period_year, period_month, month_name
ORDER BY period_year ASC, period_month ASC
EOQ;
		// echo '<text>'.$queryAllOrder.'</text>';
		$commandAllOrders = $connection->createCommand($queryAllOrder);
		$resultAllOrders = $commandAllOrders->queryAll();
		$allOrderDataProvider = new \yii\data\ArrayDataProvider([
			'allModels'=>$resultAllOrders,
			'pagination'=>[
				'pageSize'=>80,
			],
			'sort'=>[
				'attributes'=>[
					[
						'name'=>'month_name',

					],
					'subtotal'
				],
			]
		]);


		$xCategories = [];
		$series = [
			[
				'name'=>'All Sales'
			]
		];
		$seriesIdx = 0;
		// use for indexing period variant
		// using in rendering sales man grid search result
		$xCatIndex = [];
		foreach($resultAllOrders as $row=>$monthlyOrder){
			$xCategories[] = $monthlyOrder['month_name'];
			$xCatIndex[$monthlyOrder['period_year'].'_'.$monthlyOrder['period_month']] = $row;
			$series[$seriesIdx]['data'][] = (float)$monthlyOrder['subtotal'];
		}
		$seriesIdx++;
		
		// IF SEARCH FORM SUBMITTED
		if($submited)
		{
			$getSalesUsers = Yii::$app->request->get('sales');
			// check if has sear for group
			$sales_ids=[]; #sales ids
			$group_ids=[]; #sale group ids
			foreach($getSalesUsers as $searchFor):
				if(preg_match('/group\:/', $searchFor)){
					// search for group
					$expl = explode(':', $searchFor);
					$group = GroupSales::find()->where(['name'=>$expl[1]])->one();
					foreach($group->groupSalesLines as $gLine):
						$sales_ids[]=$gLine->name;
					endforeach;
					$group_ids[]=$group->id;
				}else{
					$sales_ids[]=$searchFor;
				}
			endforeach;
			/*var_dump($sales_ids);
			die();*/

			if($model->date_from == $model->date_to){
				$dateQuery = "so.date_order = '{$model->date_from}'";
				$allOrderTitle .= "On ".Yii::$app->formatter->asDate($model->date_from);
			}else{
				$dateQuery = "so.date_order BETWEEN '{$model->date_from}' AND '{$model->date_to}'";
				$allOrderTitle .= " Between ".Yii::$app->formatter->asDate($model->date_from)." to ".Yii::$app->formatter->asDate($model->date_to);
			}
			// GET RESULT MONTHLY ORDER RECEIVED FOR SALES
			$salesMonthlyOrderReceive = $this->getMonthlyOrderReceive($sales_ids,$model->date_from,$model->date_to);
			// FOR DATA PROVIDER
			$salesManSearchGrid['dataProvider'] = new \yii\data\ArrayDataProvider([
				'allModels'=>$salesMonthlyOrderReceive,
				'pagination'=>[
					'pageSize'=>100,
				]
			]);

			$salesManSearchGrid['columns']=[
				/*[
					'class'=>\yii\grid\SerialColumn::className()
				],*/
				[
					'attribute'=>'sales_name',
					'header'=>'User(s)',
				]
			];
			$countCurrColumn = 0;


			// EACH SALESMAN
			foreach($salesMonthlyOrderReceive as $row=>$saleMonthly){
				$series[$seriesIdx] = [
					'type'=>'line',
					'name'=>$saleMonthly['sales_name'],
					'data'=>[]
				];
				// var_dump($saleMonthly);
				

				$countCurrColumn = 0;
				$total[$row]['value']=0;
				foreach($saleMonthly as $fieldName=>$fieldValue):
					
					switch ($fieldName) {
						case 'user_id':
							# do nothoing
							# dont render
							break;
						case 'sales_name':
							# dont render
							break;
						default:
							# code...
							# add to series
								$total[$row]['value']+=$fieldValue;
								$series[$seriesIdx]['data'][] = (float) $fieldValue;
								#add to salesMan Grid
								
								$periodIdx = str_replace('subtotal_', '', $fieldName);

								$getIdx = $xCatIndex[$periodIdx]; #get ex: 2014_1 means period on 2014 on january

								$headerName = "";
								$explodeName = explode('_',$periodIdx);
								$headerName = Yii::$app->formatter->asDate($explodeName[0].'-'.$explodeName[1].'-01','MMM-yyyy');

								if($row==0):    
									$salesManSearchGrid['columns'][] = [
										'attribute'=>$fieldName,
										'header'=>$headerName,
										'format'=>['currency'],
										'pageSummary'=>true,
									];
								endif;

								$pieSeries[$seriesIdx] = [

									'name'=>$saleMonthly['sales_name'],
									'y'=>$total[$row]['value'],
								];
								$countCurrColumn++;
							break;
					}
				endforeach;
				
				$seriesIdx++;

			}
			// var_dump($pieSeries);
			// END FOREACH SERIES
			// var_dump($series);
			/*$series[] = [
				'type'=>'pie',
				'name'=>'Test Pie In Line',
				'data'=>[
					[
						'name'=>'G1',
						'y'=>20,
					],
					[
						'name'=>'G2',
						'y'=>40,
					],
					[
						'name'=>'G3',
						'y'=>30,
					],
					[
						'name'=>'G4',
						'y'=>10,
					],
				],
				'center'=>[950,50],
				'size'=>150,
		    	'showInLegend'=>false,
		    	'dataLabels'=>[
		    		'enabled'=>false
		    	]
			];*/
			$salesManSearchGrid['columns'][] = [
				'class'=>'\kartik\grid\FormulaColumn',
				'format'=>['currency'],
				'header'=>'Subtotal',
				'pageSummary'=>true,
				'value'=>function($model,$key,$index,$widget) use($countCurrColumn){
					$p = compact('model','key','index');
					$res = 0;
					for($c=1;$c<=($countCurrColumn);$c++):
						$res += $widget->col($c,$p);
					endfor;
					return $res;
				}
			];
		}



		return $this->render(
			'achievement',
			[
				'model'=>$model,
				'saleUsers'=>$saleUsers,
				'chart'=>[
					'xCategories'=>$xCategories,
					'series'=>$series
				],
				'allOrderDataProvider'=>$allOrderDataProvider,
				'allOrderTitle'=>$allOrderTitle,
				'submited'=>$submited,
				'salesManSearchGrid'=>(isset($salesManSearchGrid) ? $salesManSearchGrid:null),
				'pieSeries'=>(isset($pieSeries) ? array_values($pieSeries):null),
			]
		);
	}


	/**
	 * Get Order Received Annual Monthly
	 * @param  [array] $salesIds    user_id
	 * @param  [string] $date_from  Date From
	 * @param  [string] $date_to    Date To
	 * @return [array]              \yii\db\Command()->all()
	 */
	private function getMonthlyOrderReceive($salesIds=[],$date_from,$date_to)
	{
		$d1 = new \DateTime($date_from);
		$y1 = $d1->format('Y');
		$m1 = $d1->format('n');
		$d2 = new \DateTime($date_to);
		$y2 = $d2->format('Y');
		$m2 = $d2->format('n');

		// @link http://www.php.net/manual/en/class.dateinterval.php
		$interval = $d2->diff($d1);

		$interval->format('%m months');
		// var_dump($interval);
		// echo $y1.'-'.$m1.'/'.$y2.'-'.$m2;
		if($date_from == $date_to)
		{
			$dateQuery = "so.date_order = '{$date_from}'";
		}
		else
		{
			$dateQuery = "so.date_order BETWEEN '{$date_from}' AND '{$date_to}'";
		}
		$wheres = [$dateQuery];

		if(count($salesIds)){
			$saleIdsQ = implode(',',$salesIds);
		}
		
		$andWhereUserIds = "";
		
		if(count($salesIds)){
			$andWhereUserIds = " AND so.user_id in ({$saleIdsQ})";
		}

		$periods = [];
		$currM = $m1;
		$currY = $y1;
		for($m=1;$m<=$interval->m;$m++):
			if($currM>12){
				$currY++; #next year
				$currM = 1; #reset to jan
			}
			$periods[] = [
				'period_year'=>$currY,
				'period_month'=>$currM
			];
			$currM++;
		endfor;
		
		$qSelectMonthly = [];
		foreach($periods as $period):
			$period_year = $period['period_year'];
			$period_month = $period['period_month'];

			$qSelectMonthly[] = "SUM(CASE WHEN annual.period_year = '{$period_year}' AND annual.period_month = {$period_month} THEN subtotal ELSE 0 END) AS subtotal_{$period_year}_{$period_month}";
		endforeach;
		$qSelectMonthly = implode(',', $qSelectMonthly);
		
		$query = <<<EOQ
	
	SELECT 
	annual.user_id,
	p.name as sales_name,
	{$qSelectMonthly}
FROM
	(SELECT 
		CAST(EXTRACT(YEAR FROM "date_order") AS INTEGER) AS period_year,
		CAST(EXTRACT(MONTH FROM "date_order") AS INTEGER) AS period_month,
		CONCAT(TO_CHAR(TO_TIMESTAMP (CAST(EXTRACT(MONTH FROM "date_order") AS TEXT), 'MM'), 'TMmon'), '-',CAST(EXTRACT(YEAR FROM "date_order") AS TEXT)) as month_name,
		user_id,
		SUM(so_rates.rates) AS subtotal
		FROM(
		select 
		so.*,
		(case when rcr.rating is null then(
			(
			case when 
				(case when rcr.rating is null and rc.id=13 then 1 else case when rcr.rating is null then 0 end end) = 0
			then 
				(select rating from res_currency_rate where currency_id=rc.id and name < so.date_order order by name desc limit 1) * amount_total
				
			else 
				(1*amount_total)
			end
			)
		)
		else
			(rcr.rating*amount_total)
		end) as rates
		from 
		sale_order as so
		join product_pricelist as ppr on so.pricelist_id = ppr.id
		join res_currency as rc on ppr.currency_id=rc.id
		left outer join res_currency_rate as rcr on rcr.currency_id=rc.id and rcr.name = so.date_order
		where 
		{$dateQuery}
		and
		so.state not in ('draft','cancel'){$andWhereUserIds}
		order by so.date_order asc) AS so_rates
	GROUP BY period_year, period_month, month_name, user_id
	ORDER BY period_year ASC, period_month ASC, user_id ASC) AS annual
JOIN res_users AS rusr ON annual.user_id = rusr.id
JOIN res_partner as p ON p.id = rusr.partner_id
GROUP BY
	annual.user_id,
	p.name
ORDER BY
	p.name
EOQ;
		// echo '<text>'.$query.'</text>';
		$connection=Yii::$app->db;
		return $connection->createCommand($query)->queryAll();
	}

	/**
	 * Finds the SaleOrder model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return SaleOrder the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = SaleOrder::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}


	public function actionGetAllUserList($search = null, $id = null) {
		$out = ['more' => false];
		$q = new \yii\db\Query;
		if (!is_null($search)) {

			
			/*$q
				->select('usr.id, prt.name as text')
				->from(ResUsers::tableName().' usr')
				->leftJoin(ResPartner::tableName().' prt','usr.partner_id=prt.id');
			$users = $q->createCommand()->queryAll();*/


			$q
				->select('usr.id, prf.name as text')
				->from(ResGroups::tableName().' rg')
				->leftJoin(ResGroupsUsersRel::tableName().' rgu', 'rgu.gid = rg.id')
				->leftJoin(ResUsers::tableName().' usr', 'usr.id=rgu.uid')
				->leftJoin(ResPartner::tableName().' prf', 'prf.id=usr.partner_id')
				->where('rg.name like :rgName')
				->addParams([':rgName'=>'All Sales User'])
				->andWhere('LOWER(prf.name) LIKE :search',[':search'=>'%'.strtolower($search).'%']);
				$users = $q->createCommand()->queryAll();
				// var_dump($q->createCommand()->sql);

			$out['results'] = array_values($users);
		}
		elseif ($id > 0) {
			
			$out['results'] = ['id' => $id, 'text' => ResUsers::find()->where(['id'=>$id])->with('partner')->one()->partner->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo \yii\helpers\Json::encode($out);
	}

	public function actionGetAllCreatorList($search = null, $id = null) {
		$out = ['more' => false];
		$q = new \yii\db\Query;
		if (!is_null($search)) {
				// $soCreator = array_values(\yii\helpers\ArrayHelper::map(SaleOrder::find()->distinct()->select('create_uid')->asArray()->all(),'create_uid','create_uid'));
				// var_dump($soCreator);
				$users = ResUsers::find()
					->select('id, login as text')
					// ->where('res_users.id in (:userList)')
					->where('lower(login) like :loginSearch')
					// ->andWhere('id in (:listCreator)')
					->addParams([':loginSearch'=>'%ani%']);
				// var_dump($users->createCommand()->queryAll());
				$out['results'] = array_values($users->createCommand()->queryAll());
		}
		elseif ($id > 0) {
			
			$out['results'] = ['id' => $id, 'text' => ResUsers::find()->where(['id'=>$id])->with('partner')->one()->partner->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo \yii\helpers\Json::encode($out);
	}
}
