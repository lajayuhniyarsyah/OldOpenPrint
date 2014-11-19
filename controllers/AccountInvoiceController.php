<?php

namespace app\controllers;

use Yii;
use app\models\AccountInvoice;
use app\models\AccountInvoiceSearch;
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
    public function actionIndex()
    {
        $searchModel = new AccountInvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    // action print
    public function actionPrint($id,$tp=1){
        $this->layout = 'printout';
        
        $model = $this->findModel($id);

        if($model->currency->name=='IDR' and $model->currency->id==13)
        {
            // if Rupiah
            return $this->render('print/fp_rp',['model'=>$model]);
        }else{
            return $this->render('print/fp_valas',['model'=>$model]);
        }
        
    }

    public function actionPrintInvoice($id,$uid=null){
        $this->layout = 'printout';
        $model=$this->findModel($id);
        $lines = [];
        foreach($model->accountInvoiceLines as $k=>$line):
            $lines[$k]['no'] = $line->sequence;
            $lines[$k]['qty'] = $line->quantity.' '.$line->uos->name;
            $lines[$k]['desc'] = nl2br($line->name);
            $lines[$k]['unit_price'] = $line->price_unit;
            $lines[$k]['ext_price'] = $line->price_subtotal;
        endforeach;

        return $this->render('print/inv',['model'=>$model,'lines'=>$lines]);
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
}
