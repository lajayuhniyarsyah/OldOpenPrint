<?php

namespace app\controllers;

use Yii;
use app\models\SalesActivity;
use app\models\SalesActivitySearch;
use \app\models\SalesActivityForm;
use app\models\SalesActivityPlan;
use app\models\ResUsers;
use app\models\ResPartner;
use app\models\WeekStatus;

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
		$salesData = new \yii\data\ArrayDataProvider([
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
	public function actionViewTimeLine($uid=null,$customer=null,$start=null)
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
			// die();
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
		}
		// if defined start and end date
		if($start){
			$now = false;
		}
		if($now){
			$plan->andWhere('sales_activity_plan.the_date <= :now')->addParams([':now'=>date('Y-m-d')]);
		}
		
		// echo $plan->createCommand()->sql;
		$dataProvider = new \yii\data\ArrayDataProvider([
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

		return $this->render('viewTimeLine',['dataProvider'=>$dataProvider,'salesActivityForm'=>$salesActivityForm,'series'=>$series,'charts'=>$charts]);
	}

	public function actionProspect(){
		$dataToRender = [];
		$dataToRender['model'] = WeekStatusLine::find()->select(['state','COUNT(id) as total'])->groupBy('state')->asArray()->all();


		$dataToRender['salesActivityForm'] = new SalesActivityForm();
		return $this->render('prospect',$dataToRender);
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
				'condition'=>\yii\Helpers\Json::encode(['pid'=>floatval($act['actual_partner_id']),'uid'=>floatval($uid),'custName'=>$act['name']]),
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
