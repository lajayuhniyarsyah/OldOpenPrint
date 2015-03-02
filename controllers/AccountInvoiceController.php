<?php

namespace app\controllers;

use Yii;
use app\models\AccountInvoice;
use app\models\AccountInvoiceSearch;
use app\models\OrderInvoiceReportForm;
use app\models\ResUsers;

use app\models\ResGroups;
use app\models\ResGroupsUsersRel;
use app\models\GroupSales;
use app\models\GroupSalesLine;


use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccountInvoiceController implements the CRUD actions for AccountInvoice model.
 */
class AccountInvoiceController extends Controller
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
	 * Lists all AccountInvoice models.
	 * @return mixed
	 */
	public function actionIndex($type=null,$start_date=null,$end_date=null,$uid=null)
	{
		$searchModel = new AccountInvoiceSearch();


		
		if($type):
			if(preg_match('/out/', $type)){
				$type = 'out_invoice';
			}else{
				$type = 'in_invoice';
			}
			$searchModel->type = $type;
		endif;
		

		if($start_date && $end_date){
			$searchModel->date_invoice = $start_date.' To '.$end_date;
		}

		if($uid){
			$searchModel->user_id=(int)$uid;
		}

		// $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider = $searchModel->search();
		if($searchModel->load(Yii::$app->request->queryParams) && $searchModel->validate()){
			$dataProvider = $searchModel->search();
		}
		// var_dump(Yii::$app->request->queryParams);
		
		$paymentData = $searchModel->searchPaymentStatus();
		

		$pie=[
			'series'=>[]
		];
		foreach($paymentData as $payment):
			$pie['series'][] = [
				'name'=>$payment['status'],
				'y'=>floatval($payment['subtotal']),
				'color'=>($payment['status']=='Canceled' ? '#DC3912':($payment['status']=='Paid'?'#109618':'#3366CC')),
				'drilldown'=>str_replace(' ', '', strtolower($payment['status'])).'drill'
			];
			// prepare drill down
			$listStatus = $searchModel->searchPaymentStatus(true,$payment['status']);
			$drill = [];
			foreach($listStatus as $status):
				$drill[] = [
					'name'=>$status['name'],
					'y'=>floatval($status['subtotal']),
				];
			endforeach;
			$pie['drilldown'][]=[
				'id'=>str_replace(' ', '', strtolower($payment['status'])).'drill',
				'name'=>$payment['status'],
				'type'=>'pie',
				'data'=>$drill
			];
		endforeach;
		// var_dump($pie);
		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'pie'=>$pie,
		]);
	}

	// action print
	public function actionPrint($id,$uid=null,$printer="refa"){
        $this->layout = 'printout';
        $discount = ['desc'=>'','curr'=>'','amount'=>''];
        $model = $this->findModel($id);

        $lines = [];
        $total = 0;
        foreach($model->accountInvoiceLines as $invLine):
            if($invLine->account_id<>192){
                $nameLine = $invLine->product->name_template;

                if(!empty(trim($invLine->name))):
                    $nameLine .= '<br/>'.nl2br($invLine->name);
                endif;

                $nameLine .= '<br/>P/N : '.$invLine->product->default_code;
                $lines[] = [
                    'no'=>$invLine->sequence,
                    'name'=>$nameLine,
                    'price_subtotal'=>Yii::$app->numericLib->westStyle($invLine->price_subtotal),
                ];
                $total+=floatval($invLine->price_unit)*floatval($invLine->quantity);
                /*echo 'price unit '.$invLine->price_unit;
                echo 'qty '.floatval($invLine->quantity).'<br/>';*/
            }
            else
            {
                $discount = [
                    'desc'=>$invLine->name,
                    'curr'=>$model->currency->name,
                    'amount'=>$invLine->price_unit,
                ];
            }

        endforeach;
        // echo $total;
        // print_r($lines);
        if($uid==100){
            $printer='sri';
        }
        if($model->currency->name=='IDR' and $model->currency->id==13)
        {
            // if Rupiah
            return $this->render('print/fp_rp',['model'=>$model,'lines'=>$lines,'uid'=>$uid,'printer'=>$printer]);
        }else{
            return $this->render('print/fp_valas',['model'=>$model,'lines'=>$lines,'uid'=>$uid,'printer'=>$printer,'discount'=>$discount,'total'=>$total]);
        }        
    }

	public function actionPrintInvoice($id,$uid=null,$printer="refa"){
        $this->layout = 'printout';
        $model=$this->findModel($id);
        $lines = [];
        $discountLine=['desc'=>'','amount'=>'','currCode'=>''];
        $ar = 0;
        $total = 0;
        $formated = function($value) use ($model){
            if($model->currency_id==13){
                return Yii::$app->numericLib->indoStyle(floatval($value));
            }else{
                return Yii::$app->numericLib->westStyle(floatval($value));
            }
        };
        foreach($model->accountInvoiceLines as $k=>$line):
            if($line->account_id<>192){
                $ar = $k;
                $lines[$k]['no'] = $line->sequence;
                $lines[$k]['qty'] = $line->quantity.(isset($line->uos->name) ? ' '.$line->uos->name:null);
                $lines[$k]['desc'] = (isset($line->product->name_template) ? $line->product->name_template.'<br/>'.$line->name.'<br/>P/N : '.$line->product->default_code:nl2br($line->name));
                $lines[$k]['unit_price'] = '<div style="float:left;">'.$model->currency->name.'</div><div style="float:right;padding-right:8px;">'.$formated($line->price_unit).'</div>';
                $lines[$k]['ext_price'] = '<div style="float:left;">'.$model->currency->name.'</div><div style="float:right;">'.$formated($line->price_subtotal).'</div>';
                $total+=floatval($line->price_unit)*floatval($line->quantity);
            }else{
                $discountLine = [
                    'desc'=>$line->name,
                    'amount'=>$line->price_unit,
                    'currCode'=>$model->currency->name
                ];
            }

        endforeach;
        $ar+=1;
        $lines[$ar]['no'] = '';
        $lines[$ar]['qty'] = '';
        $lines[$ar]['desc'] = 'PO No : '.$model->name;
        if($model->comment){
            $lines[$ar]['desc'] .= '<br/>'.$model->comment;
        }
        $lines[$ar]['unit_price'] = '';
        $lines[$ar]['ext_price'] = '';
        if($uid==100){
            $printer='sri';
        }

        return $this->render('print/inv',['model'=>$model,'lines'=>$lines,'printer'=>$printer,'discountLine'=>$discountLine,'total'=>$total]);
    }

	/**
	 * Displays a single AccountInvoice model.
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
	 * Creates a new AccountInvoice model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new AccountInvoice();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing AccountInvoice model.
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
	 * Deletes an existing AccountInvoice model.
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
	 * Finds the AccountInvoice model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return AccountInvoice the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = AccountInvoice::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}


	public function actionDashboard(){
		$title['between'] = "";
		$connection = \Yii::$app->db;

		$model = new OrderInvoiceReportForm();

		$saleGroup = ResGroups::findOne(['name'=>'All Sales User']);
		$saleUsers = ArrayHelper::map($saleGroup->users,'id','name');
		$aiSearch = new AccountInvoiceSearch();
		$aiSearch->start_date = '2014-07-01'; #DEFAULT START DATE FROM JULLY 2014 CAUSE ERP START LIVE IN JULY 2014

		$aiSearch->end_date = date('Y-m-d');
		$submited = false;
		$sales_ids=[]; #sales ids if empty then show all sales man data

		if($model->load(Yii::$app->request->get())):
			$submited = true;
			$aiSearch->start_date = $model->date_from;
			$aiSearch->end_date = $model->date_to;


			// Sales ids
			$getSalesUsers = Yii::$app->request->get('sales');
			// check if has sear for group
			
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
			$aiSearch->sales_ids = $sales_ids;
		endif;

		$ai = $aiSearch->getSum(); #result from query->all()


		$resGrid['dataProvider'] = new \yii\data\ArrayDataProvider([
			'allModels'=>$ai,
			'pagination'=>[
				'pageSize'=>100,
			]
		]);
		$fields = array_keys($ai[0]);
		$uidF = array_search('user_id',$fields); 	# SEARCH USER ID INDEX
		unset($fields[$uidF]);						# UNSET FIELD WITH SEARCHED INDEX KEY REMOVE USER_ID
		$fields = array_values($fields);			# RE GENERATE ARRAY KEY
		$totalSummaryFields = count($fields)-1;
		# INIT GRID COLUMNS FORMAT
		foreach($fields as $fieldName):
			$summary=false;
			$format='html';
			$header = ucwords(str_replace('_', ' ', $fieldName));
			if(preg_match('/summary_/', $fieldName)){
				$summary=true;
				$format='currency';
				$expl = explode('_', $fieldName);
				$monthName = \DateTime::createFromFormat('m',$expl[2]);
				$header = $expl[1].'-'.$monthName->format('F');
				$resGrid['columns'][]=[
					'attribute'=>$fieldName,
					'header'=>$header,
					'format'=>$format,
					'pageSummary'=>$summary,
					/*'value'=>function($model,$key,$index,$grid) use($fieldName){
						return Yii::$app->formatter->asCurrency($model[$fieldName]);
					}*/
				];
			}else{
				$resGrid['columns'][]=[
					'attribute'=>$fieldName,
					'header'=>$header,
					'format'=>$format,
					'pageSummary'=>$summary,
					'value'=>function($model,$key,$index,$grid) use($fieldName, $aiSearch){
						return \yii\helpers\Html::a($model[$fieldName],['account-invoice/index','uid'=>$model['user_id'],'type'=>'out','start_date'=>$aiSearch->start_date,'end_date'=>$aiSearch->end_date]);
					}
				];
				
			}
			
		endforeach;
		


		$resGrid['columns'][] = [
			'class'=>'\kartik\grid\FormulaColumn',
			'format'=>['currency'],
			'header'=>'Subtotal',
			'pageSummary'=>true,
			'value'=>function($model,$key,$index,$widget) use($totalSummaryFields){
				$p = compact('model','key','index');
				$res = 0;
				
				for($c=1;$c<=($totalSummaryFields);$c++):
					$res += $widget->col($c,$p);
				endfor;
				
				return $res;
			}
		];

		// ACTION COLUMN
		/*$resGrid['columns'][]=[
			'class'=>'\yii\grid\ActionColumn',
			'template'=>'{view}',
			'buttons'=>[
				'view'=>function($url,$model,$key){
					return 'Viewsss';
				}
			]
		];*/

		$pie = [];
		$y = [];
		foreach($ai as $idx=>$inv)
		{
			foreach($fields as $fieldName){
				if($fieldName != 'sales_name'){
					if(isset($y[$idx])):
						$y[$idx] += $inv[$fieldName];
					else:
						$y[$idx] = $inv[$fieldName];
					endif;
				}
			}
			$pie['series'][]=[
				'name'=>$inv['sales_name'],
				'y'=>$y[$idx]
			];
		}
		$title['between'] = ' Between '.\DateTime::createFromFormat('Y-m-d',$aiSearch->start_date)->format('d-F-Y').' and '.\DateTime::createFromFormat('Y-m-d',$aiSearch->end_date)->format('d-F-Y');
		return $this->render('order_invoice_dashboard',['title'=>$title,'model'=>$model,'saleUsers'=>$saleUsers,'resGrid'=>$resGrid,'pie'=>$pie]);
	}
}
