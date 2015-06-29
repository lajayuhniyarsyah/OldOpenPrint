<?php

namespace app\controllers;

use Yii;
use app\models\SaleOrder;
use app\models\SaleOrderSearch;
use app\models\ResUsers;
use app\models\ResPartner;
use app\models\SaleOrderLine;
use app\models\ProductSaleReportForm;

use app\models\SaleAnnualReportForm;
use app\models\ResGroups;
use app\models\ResGroupsUsersRel;
use app\models\GroupSales;
use app\models\GroupSalesLine;
use app\models\ProductCategory;
use app\models\ProductPricelist;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\helpers\Json;
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
						'roles'=>['?'],
						'actions'=>['index']
					],
					[
						'allow'=>true,
						'roles'=>['@']
					],
					[
						'allow'=>false,
						'roles'=>['?']
					],
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
			if($getSalesUsers):
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
			endif;
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
			$groups = ArrayHelper::map(GroupSales::find()->select('id,desc')->where(['is_main_group'=>true])->asArray()->all(),'id','desc');
			
			$salesManSearchGrid['columns']=[
				/*[
					'class'=>\yii\grid\SerialColumn::className()
				],*/
				[
					'attribute'=>'sales_name',
					'header'=>'User(s)',
				],
				[
					'attribute'=>'group_id',
					'header'=>'Group',
					'value'=>function($model,$key,$col,$grid) use ($groups){
						return $groups[$model['group_id']];
					}
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
						case 'group_id':
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

		$monthDiff = ceil($interval->format('%m.%d'));
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
		for($m=1;$m<=$monthDiff;$m++):
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
	annual.group_id,
	annual.user_id,
	p.name as sales_name,
	{$qSelectMonthly}
FROM
	(SELECT 
		CAST(EXTRACT(YEAR FROM "date_order") AS INTEGER) AS period_year,
		CAST(EXTRACT(MONTH FROM "date_order") AS INTEGER) AS period_month,
		CONCAT(TO_CHAR(TO_TIMESTAMP (CAST(EXTRACT(MONTH FROM "date_order") AS TEXT), 'MM'), 'TMmon'), '-',CAST(EXTRACT(YEAR FROM "date_order") AS TEXT)) as month_name,
		group_id,
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
	GROUP BY period_year, period_month, month_name, group_id, user_id
	ORDER BY period_year ASC, period_month ASC, group_id ASC, user_id ASC) AS annual
JOIN res_users AS rusr ON annual.user_id = rusr.id
JOIN res_partner as p ON p.id = rusr.partner_id
GROUP BY
	annual.group_id,
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


	public function actionToDone($id){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$res = [];
		if(Yii::$app->request->isAjax){
			$model = SaleOrder::findOne($id);
			$model->state = 'done';

			$res = [
				'status'=>$model->update(),
			];
		}
		return $res;
	}


	   public function actionCustomerlist($search = null, $id = null) 
	{
		$out = ['more' => false];
		if (!is_null($search)) {
			$query = new Query;
			$lowerchr=strtolower($search);
			$command = Yii::$app->db->createCommand("SELECT DISTINCT id, name as text FROM res_partner WHERE lower(name) LIKE '%".$lowerchr."%' AND customer=true AND is_company=true LIMIT 20");
			$data = $command->queryAll();
			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => ResPartner::find($id)->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo Json::encode($out);
	}


	public function actionProductlist($search = null, $id = null) 
	{
		$out = ['more' => false];
		if (!is_null($search)) {
			$query = new Query;
			$lowerchr=strtolower($search);
			$command = Yii::$app->db->createCommand("SELECT DISTINCT id, name as text FROM product_template WHERE lower(name) LIKE '%".$lowerchr."%' AND purchase_ok=true LIMIT 20");
			$data = $command->queryAll();
			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => ProductTemplate::find($id)->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo Json::encode($out);
	}


	public function actionProductcategory($search = null, $id = null) 
	{
		$out = ['more' => false];
		if (!is_null($search)) {
			$query = new Query;
			$lowerchr=strtolower($search);
			$command = Yii::$app->db->createCommand("SELECT DISTINCT id, name as text FROM product_category WHERE lower(name) LIKE '%".$lowerchr."%' LIMIT 20");
			$data = $command->queryAll();
			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => ProductCategory::find($id)->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo Json::encode($out);
	}

	public function actionProductpricelist($search = null, $id = null) 
	{
		$out = ['more' => false];
		if (!is_null($search)) {
			$query = new Query;
			$lowerchr=strtolower($search);
			$command = Yii::$app->db->createCommand("SELECT DISTINCT id, name as text FROM product_pricelist WHERE lower(name) LIKE '%".$lowerchr."%' AND type='sale' LIMIT 20");
			$data = $command->queryAll();
			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => ProductPricelist::find($id)->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo Json::encode($out);
	}

	public function actionProductsales($groupBy=null)
	{
		$this->layout = 'dashboard';
		$model = new ProductSaleReportForm();
		$modelsales = new SaleOrder();
		$modelsaleine = new SaleOrderLine();

		// Data Category Product
		$category = ProductCategory::find()->all();
		$datacetegory = ArrayHelper::map($category,'id','name');

		// Data Pricelist
		$pricelist = ProductPricelist::find()->where(['type' => 'sale'])->all();
		$datapricelist = ArrayHelper::map($pricelist,'id','name');

		if ($model->load(Yii::$app->request->get())) {
			$query = $this->getSOLineRelatedQuery($model,$groupBy);

		}else{
			$query = $this->getSOLineRelatedQuery($model,$groupBy);
			$productcategory=null;
			$pricelist=null;
		}

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'key'=>'id',
			'pagination' => [
				'pageSize' => 100,
			],
		]);

		if($groupBy){
			return $this->render('productsales_form',['model'=>$model,'type'=>'search','dataProvider'=>$dataProvider,'groupBy'=>$groupBy,'datacetegory'=>$datacetegory,'datapricelist'=>$datapricelist]);
		}else{
			return $this->render('productsales_form',['model'=>$model,'type'=>'search','dataProvider'=>$dataProvider,'groupBy'=>'nogroup','datacetegory'=>$datacetegory,'datapricelist'=>$datapricelist]);
		}

	}

	public function getSOLineRelatedQuery($params = [], $groupBy = null){
		$query = new Query;


		if($params['productcategory']){
			if(is_array($params['productcategory'])){
				$category=implode(",", $params['productcategory']);		
			}else{
				$category=$params['productcategory'];		
			}
		}else{
			$category='0';
		}


		if($params['partner']){
			$partner=$params['partner'];	
		}else{
			$partner='0';	
		}
		if($params['product']){
			$product=$params['product'];
		}else{
			$product='0';
		}
		if($params['state']){
			$state=$params['state'];
		}else{
			$state='0';
		}

		if($params['date_from']){
			$dattefrom=$params['date_from'];
			$dateto=$params['date_to'];
		}else{
			$dattefrom='0';
			$dateto='0';
		}

		if($params['pricelist']){
			if(is_array($params['pricelist'])){
				$pricelist=implode(",", $params['pricelist']);	
			}else{
				$pricelist=$params['pricelist'];
			}
			
		}else{
			$pricelist='0';
		}

		// jika group
		if($groupBy){
			$query->select(['CONCAT("pc"."id", \'/\', "pid"."id", \'/\', "pc"."name", \'/\', "pid"."name",\'/\',\''.$category.'\',\'/\',\''.$partner.'\',\'/\',\''.$product.'\',\'/\',\''.$pricelist.'\',\'/\',\''.$state.'\',\'/\',\''.$dattefrom.'\',\'/\',\''.$dateto.'\') as id,
					pc.name as category,
					SUM(sol.price_unit*sol.product_uom_qty) as total,
					pid.name as pricelist']);
		}else{
			$query
				->select ('
					sol.id as id,
					so.partner_id as partner_id,
					so.date_order as date_order,
					so.name as no_po,
					rp.name as partner,
					sol.product_id as product_id,
					pp.name as product,
					sol.price_unit as price_unit,
					sol.state as state,
					pc.name as category,
					pid.name as pricelist,
					sol.product_uom_qty as qty,
					sol.name as product_desc,
					(sol.product_uom_qty*sol.price_unit) as total,
					so.name as so_no
				');
		}
		$query->from('sale_order_line as sol')
			->join('LEFT JOIN','sale_order as so','so.id=sol.order_id')
			->join('LEFT JOIN','product_template as pp','pp.id=sol.product_id')
			->join('LEFT JOIN','res_partner as rp','rp.id=so.partner_id')
			->join('LEFT JOIN','product_category as pc','pc.id=pp.categ_id')
			->join('LEFT JOIN','product_pricelist as pid','pid.id=so.pricelist_id');
		if($groupBy){
			$query->groupBy(['pc.id', 'pid.id']);
		}
		if(isset($params['partner']) && $params['partner']){
			if($params['partner']!='0')
			{
				$query->andWhere(['so.partner_id'=>explode(',',$params['partner'])]); 
			}
		}
		if(isset($params['productcategory']) && $params['productcategory']){
			if($params['productcategory']!='0')
			{
				if(is_array($params['productcategory'])){
					$query->andWhere(['pp.categ_id'=>explode(',',implode(",", $params['productcategory']))]); 	
				}else{
					$query->andWhere(['pp.categ_id'=>explode(',',$params['productcategory'])]); 
				}
				
			}
		}
		if(isset($params['product']) && $params['product']){
			 if($params['product']!='0')
		 	{
				$query->andWhere(['sol.product_id'=>explode(',',$params['product'])]); 
			}
		}
		if(isset($params['pricelist']) && $params['pricelist']){
			if($params['pricelist']!='0')
			{
				if(is_array($params['pricelist'])){
					$query->andWhere(['so.pricelist_id'=>explode(',',implode(",", $params['pricelist']))]); 	
				}else{
					$query->andWhere(['so.pricelist_id'=>explode(',',$params['pricelist'])]); 
				}
				
			}
		}
		if(isset($params['state']) && $params['state']){
			if($params['state']!='0')
				{
					$query->andWhere(['sol.state'=>explode(',',$params['state'])]); 
				}
		}
		if(isset($params['date_from']) && $params['date_from']){
			 if($params['date_from'] !='0')
			 	{
			 		$query->andWhere(['>=','so.date_order',$params['date_from']]);
			 		$query->andWhere(['<=','so.date_order',$params['date_to']]);
			 	}
		}

		$query->andWhere(['not', ['sol.product_id' => null]]); 
		if(!$groupBy){
			$query->addOrderBy(['so.date_order' => SORT_DESC]);
		}
		return $query;
	}


	public function actionDetailGrid($expandRowKey=null) {
		$this->layout = 'dashboard';
		if(isset($_POST['expandRowKey'])) $expandRowKey = $_POST['expandRowKey'];
			$model = new ProductSaleReportForm();
		if ($expandRowKey) {
			$exp = explode('/', $expandRowKey);
			$categoryid = (int)$exp[0];
			$pricelistid = $exp[1];
			$category_name = $exp[2];
			$pricelist_name = $exp[3];
			
			$category = $exp[4];
			$partner=$exp[5];
			$product=$exp[6];
			$pricelist=$exp[1];
			$state=$exp[8];
			$datefrom=$exp[9];
			$dateto=$exp[10];

			$query = $this->getSOLineRelatedQuery([
										'productcategory'=>$categoryid,
										'pricelist'=>$pricelist,
										'partner'=>$partner,
										'product'=>$product,
										'state'=>$state,
										'date_from'=>$datefrom,
										'date_to'=>$dateto,
										]);
			
			$dataProvider = new ArrayDataProvider([
				'allModels'=>$query->all(),
				'key'=>'id',
				'pagination'=>[
					'params'=>array_merge($_GET,['expandRowKey'=>$expandRowKey,]),
					'pageSize' => 100,
				]
				
			]);
			// return $this->renderAjax('_ajax_grid_detail',['dataProvider'=>$dataProvider]);
			return $this->renderPartial('_ajax_grid_detail',['dataProvider'=>$dataProvider,'category'=>$category,'pricelist'=>$pricelist,'category_name'=>$category_name,'pricelist_name'=>$pricelist_name]);
		}
		else
		{
			return '<div class="alert alert-danger">No data found</div>';
		}
	}
}

