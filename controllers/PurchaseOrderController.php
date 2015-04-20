<?php

namespace app\controllers;

use Yii;
use app\models\PurchaseOrder;
use app\models\PurchaseOrderLine;
use app\models\PurchaseOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
/**
 * PurchaseOrderController implements the CRUD actions for PurchaseOrder model.
 */
class PurchaseOrderController extends Controller
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
     * Lists all PurchaseOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PurchaseOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionPrintpo($id){
        $this->layout = 'printout';
        $model = $this->findModel($id);
        return $this->render('print/printpo',['model'=>$model]);
    }


    public function actionSupplierlist($search = null, $id = null) 
    {
        $out = ['more' => false];
        if (!is_null($search)) {
            $query = new Query;
            $lowerchr=strtolower($search);
            $command = Yii::$app->db->createCommand("SELECT DISTINCT id, name as text FROM res_partner WHERE lower(name) LIKE '%".$lowerchr."%' AND supplier=true AND is_company=true LIMIT 20");
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

    public function actionPurchasereport()
    {
        $this->layout = 'dashboard';
        $query = new Query;
        $model = new PurchaseOrder();
        $modelLine = new PurchaseOrderLine();
        $query
            ->select ('
                        pol.partner_id as partner_id,
                        po.date_order as date_order,
                        po.name as no_po,
                        rp.name as partner,
                        pol.product_id as product_id,
                        pp.name_template as product,
                        pol.price_unit as price_unit,
                        pol.state as state
                    ')
            ->from('purchase_order_line as pol')
            ->join('LEFT JOIN','purchase_order as po','po.id=pol.order_id')
            ->join('LEFT JOIN','product_product as pp','pp.id=pol.product_id')
            ->join('LEFT JOIN','res_partner as rp','rp.id=pol.partner_id')
            ->where(['pol.state'=>'confirmed'])
            ->addOrderBy(['pol.id' => SORT_DESC])
            ->limit('100');

        return $this->render('purchasereport_form', ['data'=>$query->all(),'type'=>'default','model'=>$model, 'modelline'=>$modelLine]);
    }

    public function actionPurchasereportbysupplier()
    {
        $this->layout = 'dashboard';
        $query = new Query;
        $activities = [];
        $query
                ->select ('pol.partner_id as partner_id, partner.name as name')
                ->distinct('pol.partner_id')
                ->from('purchase_order_line as pol')
                ->join('LEFT JOIN','res_partner as partner','partner.id=pol.partner_id')
                ->limit(10);

        $activities = [];

        foreach($query->all() as $idx=>$value):
             $activities[$idx] = [
                    'partner_id'=>$value['partner_id'],
                    'name'=>$value['name'],
                    'purchaseline'=>[
                        'detail'=>[],
                    ],
                ];

        $queryline = new Query;
        $queryline
            ->select ('
                        pol.partner_id as partner_id,
                        po.date_order as date_order,
                        po.name as no_po,
                        rp.name as partner,
                        pol.product_id as product_id,
                        pp.name_template as product,
                        pol.price_unit as price_unit,
                        pol.state as state
                    ')
            ->from('purchase_order_line as pol')
            ->join('LEFT JOIN','purchase_order as po','po.id=pol.order_id')
            ->join('LEFT JOIN','product_product as pp','pp.id=pol.product_id')
            ->join('LEFT JOIN','res_partner as rp','rp.id=pol.partner_id')
            ->where(['pol.partner_id'=>$value['partner_id']]);

            $activities[$idx]['purchaseline']['detail'] = $queryline->all();
        endforeach;

        // echo '<pre>';
        //     var_dump($activities);
        // echo '</pre>';
        return $this->render('purchasereport_form', ['type'=>'bysupplier', 'data'=>$activities]);
    }


    public function actionPurchasereportsearch()
    {
        $this->layout = 'dashboard';
        $query = new Query;

        $model = new PurchaseOrder();
        $modelLine = new PurchaseOrderLine();
        $model->load(Yii::$app->request->get());
        if ($model->load(Yii::$app->request->get()) AND $modelLine->load(Yii::$app->request->get())) { 
            $queryline = new Query;
                $queryline
                    ->select ('
                                pol.partner_id as partner_id,
                                po.date_order as date_order,
                                po.name as no_po,
                                rp.name as partner,
                                pol.product_id as product_id,
                                pp.name_template as product,
                                pol.price_unit as price_unit,
                                pol.state as state,
                                pol.product_qty as product_qty,
                                pid.name as pricelist
                            ')
                    ->from('purchase_order_line as pol')
                    ->join('LEFT JOIN','purchase_order as po','po.id=pol.order_id')
                    ->join('LEFT JOIN','product_pricelist as pid','pid.id=po.pricelist_id')
                    ->join('LEFT JOIN','product_product as pp','pp.id=pol.product_id')
                    ->join('LEFT JOIN','res_partner as rp','rp.id=pol.partner_id');
                    
                    if($model->partner_id){
                        $queryline->andWhere(['pol.partner_id'=>explode(',',$model->partner_id)]); 
                    }
                    if($modelLine->product_id){
                        $queryline->andWhere(['pol.product_id'=>explode(',',$modelLine->product_id)]); 
                    }
                    if($model->state=="all"){
                        
                    }else{
                        $queryline->andWhere(['pol.state'=>$model->state]); 
                    }
                    if($model->date_order){
                         $queryline->andWhere(['>=','po.date_order',$model->date_order]);
                         $queryline->andWhere(['<=','po.date_order',$model->duedate]);
                    }
                    $queryline->addOrderBy(['po.date_order' => SORT_DESC]);

        }
        return $this->render('purchasereport_form', ['type'=>'search','data'=>$queryline->all(),'model'=>$model,'modelline'=>$modelLine]);

    }
    /**
     * Displays a single PurchaseOrder model.
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
     * Creates a new PurchaseOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PurchaseOrder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PurchaseOrder model.
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
     * Deletes an existing PurchaseOrder model.
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
     * Finds the PurchaseOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PurchaseOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PurchaseOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
