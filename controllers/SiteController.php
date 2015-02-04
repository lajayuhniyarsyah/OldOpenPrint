<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SalesActivityForm;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\db\Command;
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionDashboard()
    {
        $model = new salesActivityForm();
        $model->load(Yii::$app->request->get());
        
        $allPartner = \yii\helpers\ArrayHelper::map(\app\models\ResPartner::find()->all(),'id','name');
        
        $activities = [];
        $this->layout = 'dashboard';
        $query = new Query;
        $date=date("Y-m-d") ;
        // $date='2014-10-15';
        $actual= new Query;
        $time=array('before','after');

        $day=date('w',strtotime($date));
        if($day=="1"){ $days="senin"; }else if($day=="2"){ $days="selasa"; }else if($day=="3"){ $days="rabu"; }else if($day=="4"){ $days="kamis"; }else if($day=="5"){ $days="jumat"; }else if($day=="6"){ $days="sabtu"; }

        $alldays=array('senin','selasa','rabu','kamis','jumat');
        // Penyesuaian Data Form 
        if ($model->load(Yii::$app->request->get())) {
            $date=$model->from;
            
            if($model->sales=="all")
            {
                $query
                    ->select('s.user_id as user, r.login, s.id as act_id, s.begin as begin, s.end as end')
                    ->from('sales_activity as s')
                    ->join('JOIN', 'res_users as r', 'r.id=s.user_id')
                    // ->where("begin = date_trunc('week', DATE '".$date."')")
                    ->where(['>=','s.begin',"2014-10-15"])
                    ->andWhere(['<=','s.end',"2014-12-15"])
                    ->addOrderBy(['s.begin' => SORT_DESC]);
                
                $dataplan = [];
                $datactual = [];
            $unsetIdxs = [];
            foreach($query->all() as $idx=>$value):
                $apus = false;
                $activities[$idx] = [
                    'act_id'=>$value['act_id'],
                    'sales_name'=>$value['login'],
                    'date'=>$value['begin'],
                    'activities'=>[
                        'plan'=>[],
                        'actual'=>[],  
                    ],
                ];
                
                $dataplan = [];
                    $plan= new Query;  
                    $actual = new Query;
                    foreach ($alldays as $day) {
                        $plan->from('before_plan_'.$day)
                             ->union('select * from after_plan_'.$day.' WHERE partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                             ->where(['activity_id'=>$value['act_id']])
                             ->andWhere(['partner_id'=>$model->customer]);
                        if (count($plan->all())) {
                            $activities[$idx]['activities']['plan'] = $plan->all();    
                        }else{
                            $apus = true;
                        }
                        

                        $actual->from('before_actual_'.$day)
                            ->union('select * from after_actual_'.$day.' WHERE  partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                            ->where(['activity_id'=>$value['act_id']])
                            ->andWhere(['partner_id'=>$model->customer]);
                        if (count($actual->all())) {
                            $activities[$idx]['activities']['actual'] = $actual->all();
                            $apus = false;
                        }else{
                            if($apus){
                                $apus = true;
                            }else{
                                $apus = false;
                            }
                        }


                        // if($apus){
                        //     unset($activities[$idx]);
                        // }
                    }
                    
                $datactual[$value['user']] = [
                    'name'=>$value['login'],
                    'data'=>[]
                ];

            endforeach;
            // echo '<pre>';
            // var_dump($activities);
            // echo '</pre>';
            // die();
            }
            else{
                $query
                    ->select('s.user_id as user, r.login, s.id as act_id, s.begin as begin, s.end as end')
                    ->from('sales_activity as s')
                    ->join('JOIN', 'res_users as r', 'r.id=s.user_id')
                    // ->where("begin = date_trunc('week', DATE '".$date."')")
                    ->where(['>=','s.begin',"2014-10-15"])
                    ->andWhere(['<=','s.begin',"2014-12-15"])
                    ->where(['s.user_id'=>$model->sales])
                    ->addOrderBy(['s.begin' => SORT_DESC]);
                
                $dataplan = [];
                $datactual = [];

                foreach($query->all() as $idx=>$value):
                    $activities[$idx] = [
                        'act_id'=>$value['act_id'],
                        'sales_name'=>$value['login'],
                        'date'=>$value['begin'],
                        'activities'=>[
                            'plan'=>[],
                            'actual'=>[],  
                        ],
                    ];
         
                    $dataplan = [];
                        $plan= new Query;  
                        $actual = new Query;
                       
                        if($model->customer=="all"){
                            $plan->from('before_plan_'.$days)
                                    ->union('select * from after_plan_'.$days.' WHERE activity_id='.$value['act_id'])
                                    ->where(['activity_id'=>$value['act_id']]);

                             $actual->from('before_actual_'.$days)
                                    ->union('select * from after_actual_'.$days.' WHERE activity_id='.$value['act_id'])
                                    ->where(['activity_id'=>$value['act_id']]);
                        }else{
                            $plan->from('before_plan_'.$days)
                                    ->union('select * from after_plan_'.$days.' WHERE partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                                    ->where(['activity_id'=>$value['act_id']])
                                    ->andWhere(['partner_id'=>$model->customer]);    
                            $actual->from('before_actual_'.$days)
                                    ->union('select * from after_actual_'.$days.' WHERE partner_id='.$model->customer.' AND activity_id='.$value['act_id'])
                                    ->where(['activity_id'=>$value['act_id']])
                                    ->andWhere(['partner_id'=>$model->customer]);
                        }
                        $activities[$idx]['activities']['plan'] = $plan->all();
                        $activities[$idx]['activities']['actual'] = $actual->all();

                    $datactual[$value['user']] = [
                        'name'=>$value['login'],
                        'data'=>[]
                    ];
                endforeach;
                // \yii\helpers\VarDumper::dump($activities);
            }

            return $this->render('dashboard',['activities'=>$activities,'model'=>$model,'allPartner'=>$allPartner]);
        }else{
            $query
                ->select('s.user_id as user, r.login, s.id as act_id')
                ->from('sales_activity as s')
                ->join('JOIN', 'res_users as r', 'r.id=s.user_id')
                ->where("begin = date_trunc('week', DATE '".$date."')")
                ->addOrderBy(['s.user_id' => SORT_ASC]);

            $dataplan = [];
            $datactual = [];
            // Data Plan Activity
            foreach($query->all() as $idx=>$value):
                $activities[$idx] = [
                    'act_id'=>$value['act_id'],
                    'sales_name'=>$value['login'] .' '.$value['act_id'],
                    'date'=>$date,
                    'activities'=>[
                        'plan'=>[],
                        'actual'=>[],  
                    ],
                ];
     
                $dataplan = [];
                    $plan= new Query;  
                    $actual = new Query;
                    $plan->from('before_plan_'.$days)->union('select * from after_plan_'.$days.' WHERE activity_id='.$value['act_id'])->where(['activity_id'=>$value['act_id']]);
                    $activities[$idx]['activities']['plan'] = $plan->all();

                    $actual->from('before_actual_'.$days)->union('select * from after_actual_'.$days.' WHERE activity_id='.$value['act_id'])->where(['activity_id'=>$value['act_id']]);
                    $activities[$idx]['activities']['actual']    = $actual->all();

                $datactual[$value['user']] = [
                    'name'=>$value['login'],
                    'data'=>[]
                ];

            endforeach;
            return $this->render('dashboard',['activities'=>$activities,'model'=>$model,'allPartner'=>$allPartner]);
        }
        // echo '<pre>';
        //     print_r($activities);
        // echo '</pre>';
    }
    public function actionActivity()
    {
        $model = new salesActivityForm();

        $allPartner = \yii\helpers\ArrayHelper::map(\app\models\ResPartner::find()->all(),'id','name');
        $this->layout = 'dashboard';
        return $this->render('/report-sales/activityform',['model'=>$model,'allPartner'=>$allPartner]);      
    }


    public function actionReportactivity()
    {
        // $this->layout = 'dashboard';
        $model = new SalesActivityForm;
        $model->load(Yii::$app->request->get());
        $query = new Query;
        $time=array('before','after');
        $day=array('senin','selasa','rabu','kamis','jumat');
        if($model->type=='1'){
            $type='plan';
        }else if($model->type=='2'){
            $type='actual';
        }else{
            $type='all';
        }
        
        if($type=='all'){
            // Model Type All Plan & Actual
            echo 'All Type';
        }else{
            // Jika Pilih salah satu plan atau actual
            if($model->sales=='all'){
                // Pilih seluruh sales dan plan atau actual
                echo 'all Sales';
            }else{
                // Pilih satu sales dan plan atau actual
                    foreach ($time as $val) {
                        foreach ($day as $value) {
                            $query
                                ->select('
                                        d.name as name,
                                        d.location as location,
                                        ')
                                ->from(''.$val.'_'.$type.'_'.$value.' as d')
                                ->join('LEFT JOIN','sales_activity as s','s.id=d.activity_id')
                                ->where(['d.partner_id'=>$model->customer]);

                        }
                    }
            }
        }
        print_r($query->all());
        // return $this->render('/report-sales/activityreport',['model'=>$model]);      
           
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTes(){
        
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
