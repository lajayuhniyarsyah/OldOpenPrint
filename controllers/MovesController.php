<?php

namespace app\controllers;

use Yii;
use app\models\StockPicking;
use app\models\StockPickingSearch;
use app\models\StockLocation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * MovesController implements the CRUD actions for StockPicking model.
 */
class MovesController extends Controller
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
     * Lists all StockPicking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StockPickingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * @param $id StockPicking ID
    **/
    public function actionPrint($id,$uid,$page=1,$maxItemPerPage=17){
        $this->layout = 'printout';
        $model = $this->findModel($id);
        $dest = [];
        $locDest = null;

        $user = \app\models\ResUsers::findOne($uid);
        // var_dump(count($model->stockMoves));
        $renderTo = 'print';
        if($model->type == 'in'){

        }elseif($model->type=='out'){

        }elseif($model->type=='internal'){
            $renderTo='printInternal';
        }else{

        }
        foreach($model->stockMoves as $move):
            if(!isset($dest[$move->location_dest_id])){
                $dest[$move->location_dest_id] = $move->locationDest->id;
                $locDest = $move->location_dest_id;
            }
        endforeach;
        $partner = false;
        if(count($dest)!=1){
            throw new \yii\web\NotAcceptableHttpException("Something Wrong With data that Your Trying to Access");
        }else{

            $partner = StockLocation::findOne($locDest);
        }

        return $this->render($renderTo,['model'=>$model,'partner'=>$partner,'page'=>$page,'maxItemPerPage'=>$maxItemPerPage,'user'=>$user]);
    }

    public function actionPrintTest($id,$uid,$page=1,$maxItemPerPage=17){
        $this->layout = 'printout';
        $model = $this->findModel($id);
        $dest = [];
        $locDest = null;

        $user = \app\models\ResUsers::findOne($uid);
        // var_dump(count($model->stockMoves));
        $renderTo = 'print';
        if($model->type == 'in'){

        }elseif($model->type=='out'){

        }elseif($model->type=='internal'){
            $renderTo='printDummy';
        }else{

        }
        foreach($model->stockMoves as $move):
            if(!isset($dest[$move->location_dest_id])){
                $dest[$move->location_dest_id] = $move->locationDest->id;
                $locDest = $move->location_dest_id;
            }
        endforeach;
        $partner = false;
        if(count($dest)!=1){
            throw new \yii\web\NotAcceptableHttpException("Something Wrong With data that Your Trying to Access");
        }else{

            $partner = StockLocation::findOne($locDest);
        }

        return $this->render($renderTo,['model'=>$model,'partner'=>$partner,'page'=>$page,'maxItemPerPage'=>$maxItemPerPage,'user'=>$user]);
    }

    /**
     * Displays a single StockPicking model.
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
     * Creates a new StockPicking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StockPicking();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StockPicking model.
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
     * Deletes an existing StockPicking model.
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
     * Finds the StockPicking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StockPicking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StockPicking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
