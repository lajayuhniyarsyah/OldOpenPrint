<?php

namespace app\controllers;

use Yii;
use app\models\MrpBom;
use app\models\MrpBomSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BomController implements the CRUD actions for MrpBom model.
 */
class BomController extends Controller
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
     * Lists all MrpBom models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MrpBomSearch();
        $dataProvider = $searchModel->searchPhantom(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MrpBom model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $bomModel  =$this->findModel($id);

        $movesSearchModel = new \app\models\StockMoveSearch();
        $movesDataProvider = $movesSearchModel->search(['StockMoveSearch'=>['product_id'=>$bomModel->product_id]]);
        

        return $this->render('view', [
            'model' => $bomModel,
            'moves'=>[
                'searchModel'=>$movesSearchModel,
                'dataProvider'=>$movesDataProvider,
            ]
        ]);
    }

    /**
     * Creates a new MrpBom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MrpBom();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MrpBom model.
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
     * Deletes an existing MrpBom model.
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
     * Finds the MrpBom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MrpBom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MrpBom::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
