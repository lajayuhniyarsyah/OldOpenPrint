<?php

namespace app\controllers;

use Yii;
use app\models\PurchaseOrder;
use app\models\PurchaseOrderLine;
use app\models\PurchaseOrderSearch;
use app\models\ProductSaleReportForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

use yii\grid\GridView;

use app\models\SaleOrder;
use app\models\SaleOrderSearch;
use app\models\ResUsers;
use app\models\ResPartner;
use app\models\SaleOrderLine;

use app\models\SaleAnnualReportForm;
use app\models\ResGroups;
use app\models\ResGroupsUsersRel;
use app\models\GroupSales;
use app\models\GroupSalesLine;
use app\models\ProductCategory;
use app\models\ProductPricelist;
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

    public function actionPurchasereport($groupBy=null)
    {
        $this->layout = 'dashboard';
        $query = new Query;
        $model = new PurchaseOrder();
        $modelLine = new PurchaseOrderLine();
        $model->load(Yii::$app->request->get());
        $modelLine->load(Yii::$app->request->get());

        if ($model->load(Yii::$app->request->get()) AND $modelLine->load(Yii::$app->request->get())) {
            $query = $this->getPOLineRelatedQuery($model,$modelLine,$groupBy);
        }else{
            $query = $this->getPOLineRelatedQuery($model,$modelLine,$groupBy);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key'=>'id',
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        if($groupBy){
            return $this->render('purchasereport_form', ['type'=>'search','model'=>$model,'modelline'=>$modelLine,'dataProvider'=>$dataProvider,'groupBy'=>$groupBy]);
        }else{
            return $this->render('purchasereport_form', ['type'=>'search','model'=>$model,'modelline'=>$modelLine,'dataProvider'=>$dataProvider,'groupBy'=>'nogroup']);      
        }
    }

    public function getPOLineRelatedQuery($params = [], $modelline = [], $groupBy = null)
    {
        $query = new Query;


        if($params['partner_id']){
            $partner_id=$params['partner_id'];    
        }else{
            $partner_id='0';   
        }
        
        if($modelline){
            if($modelline['product_id']){
                $product=$modelline['product_id'];
            }else{
                $product='0';
            }    
        }else{
            $product=$params['product_id'];
        }
        

        if($params['state']){
            $state=$params['state'];
        }else{
            $state='0';
        }

        if($params['date_order']){
            $dattefrom=$params['date_order'];
            $dateto=$params['duedate'];
        }else{
            $dattefrom='0';
            $dateto='0';
        }

        // if($params['pricelist']){
        //     if(is_array($params['pricelist'])){
        //         $pricelist=implode(",", $params['pricelist']);  
        //     }else{
        //         $pricelist=$params['pricelist'];
        //     }
            
        // }else{
        //     $pricelist='0';
        // }

        if($groupBy){
            if(is_array($params['pricelist'])){
                $pricelist=implode(",", $params['pricelist']);  
            }else{
                $pricelist=$params['pricelist'];
            }
        }
        if($groupBy){

            if($groupBy=='partner'){
                $query->select(['CONCAT("pol"."partner_id", \'/\',"pid"."id",\'/\',\''.$product.'\',\'/\',\''.$state.'\',\'/\',\''.$dattefrom.'\',\'/\',\''.$dateto.'\') as id,
                    rp.name as partner,
                    SUM(pol.price_unit*pol.product_qty) as total,
                    pid.name as pricelist']);
            }
        }else{
            $query
                ->select ('
                            pol.id as id,
                            pol.partner_id as partner_id,
                            po.date_order as date_order,
                            po.name as no_po,
                            rp.name as partner,
                            pol.product_id as product_id,
                            pp.name_template as product,
                            pol.price_unit as price_unit,
                            pol.state as state,
                            pol.product_qty as product_qty,
                            pid.name as pricelist,
                            (pol.product_qty*pol.price_unit) as total,
                        ');
            }
        $query->from('purchase_order_line as pol')
                ->join('LEFT JOIN','purchase_order as po','po.id=pol.order_id')
                ->join('LEFT JOIN','product_pricelist as pid','pid.id=po.pricelist_id')
                ->join('LEFT JOIN','product_product as pp','pp.id=pol.product_id')
                ->join('LEFT JOIN','res_partner as rp','rp.id=pol.partner_id');

        if($groupBy){
            if($groupBy=='partner'){
                $query->groupBy(['pol.partner_id','rp.name', 'pid.id']);
            }
        }

        if(isset($params['partner_id']) && $params['partner_id']){
            if($params['partner_id']!='0')
                {
                    $query->andWhere(['pol.partner_id'=>explode(',',$params['partner_id'])]); 
                }
        }
       if(isset($modelline['product_id']) && $modelline['product_id']){
                if($modelline['product_id']!='0')
                    {
                        $query->andWhere(['pol.product_id'=>explode(',',$modelline['product_id'])]); 
                    }
            }

        if(isset($params['state']) && $params['state']){
            if($params['state']!='0')
                {
                    $query->andWhere(['pol.state'=>explode(',',$params['state'])]); 
                }
        }


        if(isset($params['date_order']) && $params['date_order']){
            if($params['date_order']!='0')
                {

                    $query->andWhere(['>=','po.date_order',$params['date_order']]);
                    $query->andWhere(['<=','po.date_order',$params['duedate']]);
                }
        }

        if(!$groupBy){
            $query->addOrderBy(['po.date_order' => SORT_DESC]);    
        }
        return $query;
    }


    public function actionDetailPurchase($expandRowKey=null) {
        $this->layout = 'dashboard';
        if(isset($_POST['expandRowKey'])) $expandRowKey = $_POST['expandRowKey'];
        if ($expandRowKey) {

            $exp = explode('/', $expandRowKey);
            $partner_id = (int)$exp[0];
            $pricelist = $exp[1];
            $product_id = $exp[2];
            $state = $exp[3];
            $date_order=$exp[4];
            $dateto=$exp[5];
            $query = $this->getPOLineRelatedQuery([
                                        'partner_id'=>$partner_id,
                                        'pricelist'=>$pricelist,
                                        'state'=>$state,
                                        'date_order'=>$date_order,
                                        'duedate'=>$dateto,
                                        ], 
                                        [
                                        'product_id'=>$product_id
                                        ]);
            
            $dataProvider = new ArrayDataProvider([
                'allModels'=>$query->all(),
                'key'=>'id',
                'pagination'=>[
                    'params'=>array_merge($_GET,['expandRowKey'=>$expandRowKey,]),
                    'pageSize' => 100,
                ]
                
            ]);
            return $this->renderPartial('_ajax_grid_detail',['dataProvider'=>$dataProvider,'pricelist'=>$pricelist]);
        }
        else
        {
            return '<div class="alert alert-danger">No data found</div>';
        }
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
