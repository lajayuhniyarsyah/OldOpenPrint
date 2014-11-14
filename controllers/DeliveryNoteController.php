<?php

namespace app\controllers;

use Yii;
use app\models\DeliveryNote;
use app\models\DeliveryNoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeliveryNoteController implements the CRUD actions for DeliveryNote model.
 */
class DeliveryNoteController extends Controller
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
     * Lists all DeliveryNote models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeliveryNoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DeliveryNote model.
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
     * Creates a new DeliveryNote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DeliveryNote();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DeliveryNote model.
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
     * Deletes an existing DeliveryNote model.
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
     * Finds the DeliveryNote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DeliveryNote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DeliveryNote::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    // action print
    public function actionPrint($id,$tp=1){
        $this->layout = 'printout';
        
        $model = $this->findModel($id);
        $linesData = [];
        foreach($model->deliveryNoteLines as $line):
            array_push($linesData,[
                'qty'=>'<div style="width:100%;"><div style="width:40%;float:left;">'.$line->no.'</div><div style="width:40%;float:left;">'.$line->product_qty.$line->productUom->name.'</div><div style="clear:both;"></div></div>',
                'name'=>$line->name,
                'part_no'=>$line->product->default_code,
            ]); 

        endforeach;
        
        // if Rupiah
        return $this->render('print/dn_batch',['model'=>$model,'linesData'=>$linesData]);
        
    }
}
