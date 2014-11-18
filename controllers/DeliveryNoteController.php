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

        // PREPARE LINE DATA FOR PRINT
        // $linesData = [];
        $sets = [];
        /*array_push($linesData,[
            'qty'=>'<div style="width:100%;"><div style="width:40%;float:left;">'.$line->no.'</div><div style="width:40%;float:left;">'.$lineQty.'</div><div style="clear:both;"></div></div>',
            'name'=>$lineName,
            'part_no'=>$line->product->default_code,
        ]);*/
        $prepLines = $this->prepareLineData($model->deliveryNoteLines);
        /*echo '<pre>';
        var_dump($prepLines);
        echo '</pre>';*/
        $linesData = $this->renderLinesPrint($prepLines);

        // if Rupiah
        return $this->render('print/dn_batch',['model'=>$model,'linesData'=>$linesData]);
        
    }


    private function renderLinesPrint($preparedLines)
    {
        $res = [];
        foreach($preparedLines as $k=>$l):
            $res[$k]=[
                'qty'=>'<div style="float:left;width:10mm;">'.$l['no'].'</div><div>'.floatval($l['qty']).' '.$l['uom'].'</div><div style="clear:both;"></div>',
                'name'=>$l['name'],
                'part_no'=>$l['part_no']
            ];
            if(array_key_exists('set', $l)){
                $res[$k]['name'].='<br/>Consist Of : <ul style="margin:0;">';
                foreach($l['set'] as $set){
                    $res[$k]['name'] .= '<li>'.$set['name'].'</li>';
                    if(array_key_exists('batches', $set) && count($set['batches'])>=1):
                        /*$res[$k]['name'].='Taken From :<ul style="margin:0;">';

                        foreach($set['batches'] as $batch):
                            $res[$k]['name'].='<li>Batch No : '.$batch['name'].' - '.$batch['qty'].' '.$set['uom'].' (Exp Date '.Yii::$app->formatter->asDatetime($batch['exp_date'], "php:d/m/Y").')</li>';
                        endforeach;

                        $res[$k]['name'].='</ul>';*/


                        $res[$k]['name'].=$this->prepareBathesRender($set);

                    endif;
                }
                $res[$k]['name'].='</ul>';
            }


            if(array_key_exists('batches', $l) && count($l['batches'])>=1)
            {

                $res[$k]['name'].='<br/>'.$this->prepareBathesRender($l);
            }
        endforeach;
        return $res;
    }

    private function prepareBathesRender($line){
        $res ='Taken From :<ul style="margin:0;">';

        foreach($line['batches'] as $batch):
            $res .= '<li>Batch No : '.$batch['name'].' - '.$batch['qty'].' '.$line['uom'].' '.($batch['exp_date'] ? '(Exp Date '.Yii::$app->formatter->asDatetime($batch['exp_date'], "php:d/m/Y").')':null).'</li>';
        endforeach;

        $res .='</ul>';
        return $res;
    }

    private function prepareLineData($lines)
    {
        $res = [];
        foreach($lines as $k=>$line):

            // if set
            if(isset($line->opLine->move->move_dest_id) && $line->opLine->move->move_dest_id)
            {
                $moveDest = $line->opLine->move->moveDest;
                // before we must check if move dest id setted
                if(array_key_exists($moveDest->id, $res))
                {
                    $res[$moveDest->id]['set'][] = $this->prepareSetPrint($line);
                }
                else
                {
                    // init to be printed
                    $res[$moveDest->id] = [
                        'no'=>$line->no,
                        'qty'=>$moveDest->product_qty,
                        'uom'=>$moveDest->productUom->name,
                        'name'=>($moveDest->desc ? nl2br($moveDest->desc):nl2br($moveDest->name)),
                        'set'=>[
                            $this->prepareSetPrint($line),
                        ],
                        'part_no'=>$line->product->default_code,
                    ];

                }


            }
            else
            {
                // not set
                $res[$line->id]=$this->prepareLine($line);
            }
        endforeach;
        return $res;
    }

    private function prepareLine($line,$printHead=true)
    {
        $res = [];
        if(isset($line->opLine->orderPreparationBatches) && $line->opLine->orderPreparationBatches)
        {
            if($printHead==true):
                $res =[
                    'no'=>$line->no,
                    'qty'=>$line->product_qty,
                    'uom'=>$line->productUom->name,
                    'name'=>nl2br($line->name),
                    'part_no'=>$line->product->default_code,
                    'batches'=>[]
                ];
            endif;
            foreach($line->opLine->orderPreparationBatches as $batch):
                $res['batches'][]=['name'=>$batch->name0->name,'desc'=>$batch->desc,'qty'=>$batch->qty,'exp_date'=>$batch->exp_date];
            endforeach;
        }
        else
        {
            if($printHead==true)
                $res=[
                    'no'=>$line->no,
                    'qty'=>$line->product_qty,'uom'=>$line->productUom->name,'name'=>nl2br($line->name),'part_no'=>$line->product->default_code];
        }
        return $res;
    }

    private function prepareBatches($line){
        $res = [];
        if($line->opLine->orderPreparationBatches)
        {
            foreach($line->opLine->orderPreparationBatches as $batch):
                $res[]=['name'=>$batch->name0->name,'desc'=>$batch->desc,'qty'=>$batch->qty,'exp_date'=>$batch->exp_date];
            endforeach;
        }
        return $res;
    }

    private function prepareSetPrint($line){
        return [
            'qty'=>$line->product_qty,
            'uom'=>$line->productUom->name,
            'name'=>($line->name ? nl2br($line->name):$line->product->name),
            'batches'=>$this->prepareBatches($line),
            'part_no'=>$line->product->default_code,
        ];
    }
}
