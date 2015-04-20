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
use app\models\ExecutiveSummarySales;
use app\models\ExecutiveSummaryGroup;
use app\models\ExecutiveSummaryGroupSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\data\ActiveDataProvider;
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
	public function actionPrint($id,$uid=null,$printer=null){
        $this->layout = 'printout';
        $discount = ['desc'=>'','curr'=>'','amount'=>''];
        $model = $this->findModel($id);

        $lines = [];
        $total = 0;

        foreach($model->accountInvoiceLines as $invLine):
            if($invLine->account_id<>192){
                $nameLine = (isset($invLine->product->name_template) ? $invLine->product->name_template : null);

                if(!trim($invLine->name)):
                    $nameLine .= (isset($invLine->product->name_template) ? '<br/>':"").nl2br($invLine->name);
                endif;

                if(isset($invLine->product->default_code)){
                    $nameLine .= '<br/>P/N : '.$invLine->product->default_code;
                }
                
                if($model->currency_id==13){
                    $priceSub = Yii::$app->numericLib->indoStyle($invLine->price_subtotal);
                }else{
                    $priceSub = Yii::$app->numericLib->westStyle($invLine->price_subtotal);
                }
                $lines[] = [
                    'no'=>$invLine->sequence,
                    'name'=>$nameLine,
                    'price_subtotal'=>$priceSub,
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

        # IF NOT PRINT ALL TAXES THEN GET ITEM IN SALES ORDER RECORD AND PUT IT TO LINES
       	if(!$model->print_all_taxes_line){
       		unset($lines); #reset Lines
       		$lines = [];
        	$lines[] = [
        		'no'=>'',
        		'name'=>($model->currency_id == 13 ? 'Sesuai Invoice ':'As Per Invoice No. ').$model->kwitansi.($model->currency_id	==13 ? '<br/>(Lampiran Invoice : 1, 2)':'<br/>(List Find Attach In Invoice Page : 1, 2)'),
        		// 'AS PER INVOICE NO. LIST FIND ATTACH IN INVOICE PAGE 1, 2'
        		'price_subtotal'=>($model->currency_id == 13 ? Yii::$app->numericLib->indoStyle($total):Yii::$app->numericLib->westStyle($total))
        	];
        }
        // echo $total;
        // print_r($lines);
        if($uid==100 && !$printer){
            $printer='sri';
        }elseif(!$printer){
            $printer = 'refa';
        }
        if($model->currency->name=='IDR' and $model->currency->id==13)
        {
            // if Rupiah
            return $this->render('print/fp_rp',['model'=>$model,'lines'=>$lines,'uid'=>$uid,'printer'=>$printer,'discount'=>$discount,'total'=>$total]);
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
                $lines[$k]['no'] = ($model->payment_for == 'dp' || $model->payment_for == 'completion' ? '':$line->sequence);
                $lines[$k]['qty'] = ($model->payment_for == 'dp' || $model->payment_for == 'completion' ? '':$line->quantity.(isset($line->uos->name) ? ' '.$line->uos->name:null));
                
                if($model->payment_for == 'dp' || $model->payment_for=='completion'){
                	$lines[$k]['desc'] = (isset($line->product->name_template) ? $line->product->name_template.'<br/>'.$line->name.'<br/>P/N : '.$line->product->default_code:nl2br($line->name));
                	if(preg_match('/FOR \:/', $lines[$k]['desc'])){
                		$expl = explode('FOR :', $lines[$k]['desc']);
                		$lines[$k]['desc'] = '<b>'.$expl[0].' FOR :'.'</b>';
                	}
                	$dpName = '';
                	$lines[$k]['unit_price'] = '<div style="float:left;">'.$model->currency->name.'</div><div style="float:right;padding-right:8px;">'.$formated($line->price_unit).'</div>';
                	$lines[$k]['ext_price'] = '<div style="float:left;">'.$model->currency->name.'</div><div style="float:right;">'.$formated($line->price_subtotal).'</div>';
                }else{
                	$lines[$k]['desc'] = (isset($line->product->name_template) ? $line->product->name_template.'<br/>'.$line->name.'<br/>P/N : '.$line->product->default_code:nl2br($line->name));
                	$lines[$k]['unit_price'] = '<div style="float:left;">'.$model->currency->name.'</div><div style="float:right;padding-right:8px;">'.$formated($line->price_unit).'</div>';
                	$lines[$k]['ext_price'] = '<div style="float:left;">'.$model->currency->name.'</div><div style="float:right;">'.$formated($line->price_subtotal).'</div>';
                }
                
                $total+=floatval($line->price_unit)*floatval($line->quantity);
            }else{
                $discountLine = [
                    'desc'=>$line->name,
                    'amount'=>$line->price_unit,
                    'currCode'=>$model->currency->name
                ];
            }

        endforeach;

        // IF DP OR COMPLETION
       	if($model->payment_for == 'dp'|| $model->payment_for=='completion'){
       		foreach($model->orders as $so){
       			foreach($so->saleOrderLines as $line){
       				$ar++;
       				$lines[$ar]['no'] = $line->sequence;
	                $lines[$ar]['qty'] = $line->product_uom_qty.(isset($line->productUom->name) ? ' '.$line->productUom->name:null);
	                $lines[$ar]['desc'] = (isset($line->product->name_template) ? $line->product->name_template.'<br/>'.$line->name.'<br/>P/N : '.$line->product->default_code:nl2br($line->name));
	                $lines[$ar]['unit_price'] = '';
	                $lines[$ar]['ext_price'] = '';
       			}
       		}
       	}



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
			$model->sales = Yii::$app->request->get('sales');

			$submited = true;
			$aiSearch->start_date = $model->date_from;
			$aiSearch->end_date = $model->date_to;
			$getSalesUsers = [];
			// if($model->validate()){
				// Sales ids
			$getSalesUsers = Yii::$app->request->get('sales');
			// }else{
				// Yii::$app->session->setFlash('danger','SalesMan is not valid');
			$salesError = true;
			// }
			
			// check if has sear for group
			// FIND BY GROUP
			$group_ids=[]; #sale group ids
			if($getSalesUsers):
				// echo 'AAAAAAAAA';
				foreach($getSalesUsers as $searchFor):
					if(preg_match('/group\:/', $searchFor)){
						// search for group
						$expl = explode(':', $searchFor);
						$groupQ = GroupSales::find()->where(['is_main_group'=>true,'name'=>$expl[1]]);
						// var_dump($groupQ->createCommand()->sql);
						$group = $groupQ->one();
						/*foreach($group->groupSalesLines as $gLine):
							$sales_ids[]=$gLine->name;
						endforeach;*/
						$group_ids[]=$group->id;
					}else{
						$sales_ids[]=$searchFor;
					}
				endforeach;

			endif;
			$aiSearch->group_ids = $group_ids;
			$aiSearch->sales_ids = $sales_ids;
		endif;
		// var_dump($aiSearch->group_ids);
		$ai = $aiSearch->getSum(); #result from query->all()

		

		// \yii\helpers\VarDumper::dump($aiPie);
		$resGrid['dataProvider'] = new \yii\data\ArrayDataProvider([
			'allModels'=>$ai,
			'pagination'=>[
				'pageSize'=>100,
			]
		]);
		$aiPie = $aiSearch->getSumGroup();
		/*var_dump($ai);
		die();*/
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
		foreach($aiPie as $idx=>$inv)
		{
			foreach($fields as $fieldName){
				if($fieldName != 'sales_name'){
					if(isset($y[$idx])):
						$y[$idx] += $inv[$fieldName];
					else:
						if($fieldName != 'group_name'){
							$y[$idx] = $inv[$fieldName];
						}
						
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

	/**
	 * ESS EXECUTIVE SUMMARY SALES REPORT BY SALES MAN
	 * @param  [type] $year [description]
	 * @return [type]       [description]
	 */
	public function actionExecutiveSummaryBySalesMan($year=null,$gid=null){
		$modelSearch = new ExecutiveSummaryGroupSearch;
		$dataToRender = [];
		if(!$year) $year = date('Y'); #GET CURRENT YEAR
		
		$modelSearch->year_invoice = $year;
		$modelSearch->gid = $gid;
		// $modelSearch->user_id = 'aaaa';
		$query = $modelSearch->getQuery();

		$query->orderBy('name ASC');
		

		
		$dataArr = $query->asArray()->all();
		$ytdSales = array_map(function($v){
			return ['name'=>$v['name'],'y'=>floatval($v['ytd_target'])];
		},$dataArr);

		$ytdAchievement = array_map(function($v){
			return ['name'=>$v['name'],'y'=>floatval($v['ytd_sales_achievement'])];
		},$dataArr);
		
		
		$dataToRender['chart']['series'] = [
			[
				'name'=>'Ytd Target',
				'data'=>$ytdSales,
				'pointPadding'=>0.3,
				'pointPlacement'=>-0.1,
			],
			[
				'name'=>'Ytd Achievement',
				'data'=>$ytdAchievement,
				'pointPadding'=>0.4,
				'pointPlacement'=>-0.1,
			],
		];
		// \yii\helpers\VarDumper::dump($dataArr);
		$dataToRender['provider'] = new \yii\data\ArrayDataProvider([
		    'allModels' => $dataArr,
		    'pagination' => false
		]);


		$dataToRender['year'] = $modelSearch->year_invoice;

		$dataToRender['salesTitle'] = ($gid && isset($dataArr[0]) ? strtoupper($dataArr[0]['group_name']):'All Sales');
		// var_dump($dataToRender['salesTitle']);
		// var_dump($modelSearch->errors);
		foreach($modelSearch->errors as $error){
			Yii::$app->session->setFlash('danger',$error[0]);
		}
		
		return $this->render('executive_summary_by_sales_man',$dataToRender);
	}


	public function actionTes(){

	}
	/**
	 * ESS EXECUTIVE SALES ACHIEVEMEN DASHBOARD REPORT BY SALES GROUP
	 * @param  [type] $year [description]
	 * @return [type]       [description]
	 */
	public function actionExecutiveSummaryByGroup($year=null,$validated=false){
		$dataToRender = [];
		$model = new ExecutiveSummaryGroup;
		if(!$year) $year = date('Y'); #GET CURRENT YEAR
		$query = ExecutiveSummaryGroup::find()
			->where('year_invoice = :year')
			->addParams([':year'=>(int)$year])
			->groupBy('gid, group_name, year_invoice')
			->orderBy('group_name ASC');

		$dataArr = $query->select('year_invoice, gid, group_name, 
				SUM(amount_target) AS amount_target, SUM(ytd_target) as ytd_target, SUM(ytd_sales_achievement) as ytd_sales_achievement, 
				SUM(achievement) AS achievement')->asArray()->all();
		$ytdSales = array_map(function($v){
			return ['name'=>$v['group_name'],'y'=>floatval($v['ytd_target'])];
		},$dataArr);

		$ytdAchievement = array_map(function($v){
			return ['id'=>$v['gid'],'name'=>$v['group_name'],'y'=>floatval($v['ytd_sales_achievement'])];
		},$dataArr);
		
		
		$dataToRender['chart']['series'] = [
			[
				'name'=>'Ytd Target',
				'data'=>$ytdSales,
				'pointPadding'=>0.3,
				'pointPlacement'=>-0.1,
			],
			[
				'name'=>'Ytd Achievement',
				'data'=>$ytdAchievement,
				'pointPadding'=>0.4,
				'pointPlacement'=>-0.1,
			],
		];

		// \yii\helpers\VarDumper::dump($dataToRender['chart']['series']);

		$dataToRender['provider'] = new ActiveDataProvider([
		    'query' => $query->select('year_invoice, gid, group_name, 
				SUM(amount_target) AS amount_target, SUM(ytd_target) as ytd_target, SUM(ytd_sales_achievement) as ytd_sales_achievement, 
				SUM(achievement) AS achievement'),
		    'pagination' => [
		        'pageSize' => -1,
		    ],
		]);

		$dataToRender['year'] = (int)$year;

		return $this->render('executive_summary_by_group',$dataToRender);
	}

	public function actionGetEssGroupDetail($group,$series=null,$year=null){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$data = [];
		
		if(!$year) $year = date('Y');
		$groupObj = GroupSales::find()->where('name like :search')->addParams([':search'=>strtolower($group)])->one();
		
		if($groupObj){
			$dataArr = ExecutiveSummaryGroup::find()
				->where('year_invoice = :year AND gid = :gid')->addParams([':year'=>(int)$year,':gid'=>$groupObj->id])
				->orderBy('name ASC')->asArray()->all();
			

			$ytdSales = array_map(function($v){
				return ['name'=>$v['name'],'y'=>floatval($v['ytd_target'])];
			},$dataArr);

			$ytdAchievement = array_map(function($v){
				return ['name'=>$v['name'],'y'=>floatval($v['ytd_sales_achievement'])];
			},$dataArr);

			$series = [
				'name'=>'Ytd Achievement',
				// 'data'=>$ytdAchievement,
				'data'=>(preg_replace('/W+/','',strtolower($series)) == 'ytdtarget' ? $ytdTarget:$ytdAchievement)
			];
		}
		
		
		return \yii\helpers\Json::encode($series);

	}

	public function actionWapu(){
		$dataToRender = [];
		$searchModel = new AccountInvoiceSearch();
		$searchModel->type = 'out_invoice';
		$searchModel->faktur_pajak_no = '030.';
		$dataToRender['dataProvider'] = $searchModel->search();


		// var_dump($dataToRender);
		return $this->render('wapu',$dataToRender);
	}
}
