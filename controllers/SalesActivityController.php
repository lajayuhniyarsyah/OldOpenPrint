<?php

namespace app\controllers;

use Yii;
use app\models\SalesActivity;
use app\models\SalesActivitySearch;
use app\models\SalesActivityForm;
use app\models\SalesActivityPlan;
use app\models\ResUsers;
use app\models\ResPartner;
use app\models\WeekStatus;
use app\models\WeekStatusLine;

use yii\data\ArrayDataProvider;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalesActivityController implements the CRUD actions for SalesActivity model.
 */
class SalesActivityController extends Controller
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
		];
	}

	/**
	 * Lists all SalesActivity models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$resGroupsModel = \app\models\ResGroups::find()->where('name like :name')->addParams([':name'=>'All Sales User'])->one();
		$salesData = new ArrayDataProvider([
			'allModels'=>$resGroupsModel->users,
			'sort'=>[
				'attributes'=>[
					'name'
				],
				'defaultOrder'=>[
					'name'=>SORT_ASC
				]
			]
		]);
		$searchModel = new SalesActivitySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'salesData'=>$salesData,
		]);
	}

	/**
	 * Displays a single SalesActivity model.
	 * @param integer $uid instead user_id
	 * @return mixed
	 */
	public function actionViewTimeLine(integer $uid=null,$customer=null,$start=null)
	{
		$salesActivityForm = new SalesActivityForm;

		$charts = ['pie'=>[],'line'=>[]]; #prepared for all chart

		$now = true;

		$plan = SalesActivityPlan::find();
		$pieType = 'customer';
		$salesName = "All Sales Man";
		$salesActivityForm->sales = $uid;
		$salesActivityForm->customer = $customer;
		$salesActivityForm->date_begin = $start;


		if ($salesActivityForm->load(Yii::$app->request->get()) && $salesActivityForm->validate())
		{
			/*var_dump($salesActivityForm->date_begin);
			die();*/
			$uid=$salesActivityForm->sales;
			if($uid){
				// die();
				$salesName = ResUsers::findOne($uid)->partner->name;
				$plan->where('sales_activity_plan.user_id = :uid')
					->addParams([':uid'=>$uid]);
				$pieType = 'customer';

			}
			
			if($salesActivityForm->customer){
				$plan->andWhere('(sales_activity_plan.partner_id = :partner OR sales_activity_plan.actual_partner_id = :partner)')->addParams([':partner'=>$salesActivityForm->customer]);
				$pieType='sales';
				$custName = ResPartner::findOne($salesActivityForm->customer)->name;
			}
			$start=$salesActivityForm->date_begin;
		}else{
			$msg = [];
			foreach($salesActivityForm->errors as $error){
				foreach($error as $err){
					$msg[] = $err;
				}
			}
			if($msg){
				Yii::$app->session->setFlash('danger',implode(' and ', $msg));
			}
			
		}
		// if defined start and end date
		if($start){
			$now = false;
		}
		if($now){
			$plan->andWhere('sales_activity_plan.the_date <= :now')->addParams([':now'=>date('Y-m-d')]);
		}
		
		// echo $plan->createCommand()->sql;
		// var_dump($plan->with(['partner','user','user.partner','actualPartner'])->orderBy('year_p DESC, week_no DESC, dow DESC, user_id, daylight, not_planned_actual')->asArray()->all());
		// die();
		$dataProvider = new ArrayDataProvider([
			'allModels'=>$plan->with(['partner','user','user.partner','actualPartner'])->orderBy('year_p DESC, week_no DESC, dow DESC, user_id, daylight, not_planned_actual')->asArray()->all(),
		]);


		$pies = [];
		// var_dump($pieType);
		
		if($pieType && $pieType=='customer')
		{
			$chartData = $this->getCustomerActivityCompositionByUser($uid);
			// var_dump($chartData);
			$series = $chartData['series'];
			$pies[] = [
				'title'=>'Customer Visit Activity By '.$salesName,
				'series'=>$chartData['series'],
				'drillDown'=>$chartData['drillDown'],
				'drillDownTitle'=>'Customer Visit Activity',
			];
		}
		elseif($pieType && $pieType='sales')
		{
			$series = $this->getCustomerActivityCompositionByCustomer($salesActivityForm->customer);
			$pies[] = [
				'title'=>'Relationship Activities On '.$custName,
				'series'=>$series,
				'drillDownTitle'=>'User Visit Activity On '.ResPartner::findOne($salesActivityForm->customer)->name,
				'drillDown'=>[],
			];
			// var_dump($series);
		}
		else
		{
			$pieSeries = false;
		}
		
		$charts['pie'] = $pies;
		// var_dump($charts);
		return $this->render('viewTimeLine',['dataProvider'=>$dataProvider,'salesActivityForm'=>$salesActivityForm,'series'=>$series,'charts'=>$charts]);
	}

	public function actionProspect(){
		$dataToRender = [];
		$charts = [];
		$model = WeekStatusLine::find()
			->groupBy('year, state')
			->where('EXTRACT(year FROM "quotation") = :year')
			->addParams([':year'=>date('Y')])
			->asArray();

		$dataSeries = [];
		/*$stateGrouped = $model->select(['state'])->column();
		$countGrouped = array_map('floatval',$model->select(['COUNT(id) AS cout'])->column());
		var_dump(array_merge($stateGrouped,$countGrouped));*/

		$column = [];
		$color = [
			'lost'=>'#F15C80',
			'win'=>'#90ED7D',
			'quo'=>'#95CEFF',
			'post'=>'#5C5C61',
			'nego'=>'#F7A35C',
		];

		$dataArray = $model->select(['CONCAT(EXTRACT(YEAR FROM "quotation"),\'-\',"state") as "id"','EXTRACT(YEAR FROM "quotation") as "year"','state','COUNT(id) AS cout'])->all();
		foreach($dataArray as $k=>$d):
			$dataSeries[$k] = ['id'=>$d['state'].'-'.$d['year'],'name'=>$d['state'],'y'=>floatval($d['cout']),'color'=>$color[$d['state']],'drilldown'=>[]];
			$column[] = [
				'type'=>'column',
				'name'=>$d['state'],
				'data'=>[
					[
						'id'=>$d['state'].'-'.$d['year'],
						'y'=>floatval($d['cout'])
					]
					
				],
				'color'=>$color[$d['state']],
				// 'center'=>[150,0],
			];
		endforeach;
		$series = [];
		$pie = [

			'type'=>'pie',
			'name'=>'Prospect Summary',
			'center'=>[950,80],
			'size'=>200,
			'showInLegend'=>false,
			/*'dataLabels'=>[
				'enabled'=>false,
			],*/
			/*'data'=>[
				[
					'name'=>'satu',
					'y'=>1000,
				],
				[
					'name'=>'dua',
					'y'=>100,
				],
				[
					'name'=>'tiga',
					'y'=>400,
				],
			]*/
			'data'=>$dataSeries
		];
		// $series = [$pie];
		$series = array_merge([$pie],$column);
		$dataToRender['charts'][] = [
			'type'=>'pie',
			'series'=>$series

		];
		// \yii\helpers\VarDumper::dump($series);
		
		$dataToRender['dataProvider'] = new ArrayDataProvider([
			'allModels'=>$dataArray,
			'key'=>'id',
		]);
		$dataToRender['salesActivityForm'] = new SalesActivityForm();
		return $this->render('prospect',$dataToRender);
	}


	public function actionProspectGrid($expandRowKey=null) {
		if(isset($_POST['expandRowKey'])) $expandRowKey = $_POST['expandRowKey'];

		if ($expandRowKey) {
			$exp = explode('-', $expandRowKey);
			$year = (int)$exp[0];
			$state = $exp[1];

			$query = WeekStatusLine::find()->asArray()->with(['status0','status0.user','status0.user.partner'])->where('EXTRACT(YEAR FROM "quotation") = :year')->andWhere('state like :state')->addParams([':year'=>$year,':state'=>$state]);

			$dataProvider = new ArrayDataProvider([
				'allModels'=>$query->all(),
				'key'=>'id',
				'pagination'=>[
					'params'=>array_merge($_GET,['expandRowKey'=>$expandRowKey,])
				]
			]);
			return $this->renderAjax('_ajax_prospect_grid_detail',['dataProvider'=>$dataProvider,'state'=>WeekStatusLine::getStateAliases($state),'year'=>$year]);
			// return $this->render('_ajax_prospect_grid_detail',['dataProvider'=>$dataProvider,'state'=>WeekStatusLine::getStateAliases($state),'year'=>$year]);
		}
		else
		{
			return '<div class="alert alert-danger">No data found</div>';
		}
	}

	public function actionGetChartProspectByCustomer($param){
		// \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$arrParam = explode('-', $param);
		$data = [];
		$model = WeekStatusLine::find()
			->select(['CONCAT(EXTRACT(year FROM "quotation"),\'-\',res_partner.name,\'-\',\''.$arrParam[0].'\') AS id','EXTRACT(year FROM "quotation") AS year','res_partner.name AS name','COUNT(res_partner.name) as cout'])
			->leftJoin(ResPartner::tableName(),'week_status_line.name = res_partner.id')
			->groupBy('year, res_partner.name')
			->where('EXTRACT(year FROM "quotation") = :year')
			->andWhere('state like :state')
			->addParams([':year'=>$arrParam[1],':state'=>$arrParam[0]])
			->asArray();

		return \yii\helpers\Json::encode($model->all());
	}


	/**
	 * [getCustomerActivityCompositionByUser description]
	 * @param  [type] $uid  [description]
	 * @param  string $type [description]
	 * @return [type]       [description]
	 */
	private function getCustomerActivityCompositionByUser($uid, $type='pie')
	{
		$chartData = [];
		$plan = SalesActivityPlan::find();
		$plan->select('sales_activity_plan.actual_partner_id, res_partner.name, count(actual_partner_id) as cout')
			->groupBy(['sales_activity_plan.actual_partner_id','res_partner.name'])
			->leftJoin(ResPartner::tableName(),'res_partner.id=actual_partner_id');
		if($uid){
			$plan->where('sales_activity_plan.user_id = :uid')
			->addParams([':uid'=>$uid]);
		}
		$series = [];
		$drillDownData = [];
		$drillDown = [];
		foreach($plan->createCommand()->queryAll() as $idx=>$act){
			$series[$idx] = [
				'id'=>$act['actual_partner_id'],
				'name'=>$act['name'],
				'condition'=>\yii\helpers\Json::encode(['pid'=>floatval($act['actual_partner_id']),'uid'=>floatval($uid),'custName'=>$act['name']]),
				'y'=>floatval($act['cout']),
				'drilldown'=>true,
			];
			
			/*$drillDownData = $this->getCustomerActivityCompositionByCustomer($act['actual_partner_id']);
			$drillDown[] = [
				'id'=>'drill'.$idx,
				'type'=>'pie',
				'data'=>$drillDownData
			];*/


		}
		$chartData = [
			'series'=>$series,
			'drillDown'=>$drillDown
		];
		return $chartData;
	}


	/**
	 * ACTION FOR AJAX HIGHCHART DRILL DOWN
	 * @param  [type] $uid      [description]
	 * @param  [type] $pid      [description]
	 * @param  [type] $custName [description]
	 * @return [type]           [description]
	 */
	public function actionGetDrillDown($uid,$pid=null,$custName=null){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		if($pid){
			
			$res = [
				'name'=>"Sales Man Activity in ".$custName,
				'type'=>'pie',
				'data'=>$this->getCustomerActivityCompositionByCustomer($pid)
			];
		}else{
			// if pid is null
			// get by user
			
			$res = [
				'name'=>"Customer Activity Composition For ",
				'type'=>'pie',
				'data'=>$this->getCustomerActivityCompositionByUser($uid)
			];
		}
		return \yii\helpers\Json::encode($res);

	}

	/**
	 * [getCustomerActivityCompositionByCustomer description]
	 * @param  integer $partner_id [description]
	 * @param  string $type       [description]
	 * @return array             [description]
	 */
	private function getCustomerActivityCompositionByCustomer($partner_id,$type='pie')
	{
		$plan = SalesActivityPlan::find();
		$plan->select('res_partner.name, count(sales_activity_plan.user_id) as cout')
			->leftJoin(ResUsers::tableName(),'res_users.id=sales_activity_plan.user_id')
			->leftJoin(ResPartner::tableName(),'res_partner.id=res_users.partner_id')
			->where('sales_activity_plan.actual_partner_id = :actual_partner_id')
			->addParams([':actual_partner_id'=>$partner_id])
			->groupBy(['res_partner.name']);
		$series = [];
		foreach($plan->createCommand()->queryAll() as $idx=>$act){
			$series[$idx] = [
				'name'=>$act['name'],
				'y'=>floatval($act['cout']),
			];
		}
		
		return $series;
	}


	/**
	 * Displays a single SalesActivity model.
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
	 * Creates a new SalesActivity model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new SalesActivity();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing SalesActivity model.
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
	 * Deletes an existing SalesActivity model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the SalesActivity model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return SalesActivity the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = SalesActivity::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
