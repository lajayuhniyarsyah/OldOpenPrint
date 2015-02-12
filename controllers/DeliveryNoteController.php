<?php

namespace app\controllers;

use Yii;
use app\models\DeliveryNote;
use app\models\DeliveryNoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use app\models\PackingListLine;

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
    public function actionPrint($id,$test=0){
        $this->layout = 'printout';
        
        $model = $this->findModel($id);

        // PREPARE LINE DATA FOR PRINT
        
        $sets = [];
        
        $prepLines = $this->prepareLineData($model->deliveryNoteLines);
        
        $linesData = $this->renderLinesPrint($prepLines);
        if(!$test):
            return $this->render('print/dn_batch',['model'=>$model,'linesData'=>$linesData]);
        else:
            return $this->render('print/test/dn_batch_test',['model'=>$model,'linesData'=>$linesData]);
        endif;
    }

    

    /**
     * Print Action For Packing List
    **/
    public function actionPrintPack($id,$printer='lq300-hadi')
    {
        $this->layout = 'printout';
        
        $model = $this->findModel($id);
        // var_dump($model->packingListLines->id);
        $linesData = [];
        foreach($model->packingListLines as $k=>$listLine):
            $linesData[$k]=[
                'name'=>$listLine->name,
                'color'=>$listLine->color,
                'urgent'=>$listLine->urgent,
                'to'=>$model->partner->name,
                'attn'=>$model->partnerShipping->name,
                'date'=>$model->tanggal,
                'poc'=>$model->poc,
            ];
            $totalWeight=0;
            foreach($listLine->productListLines as $n=>$pLine):
                    $linesData[$k]['lines'][] = [
                    'no'=>$pLine->no,
                    'desc'=>nl2br($pLine->name),
                    'product'=>'['.$pLine->product->default_code.']'.$pLine->product->name_template,
                    'qty'=>floatval($pLine->product_qty).' '.$pLine->productUom->name,
                    'weight'=>($pLine->weight ? $pLine->weight:'-'),
                    'measurement'=>($pLine->measurement ? $pLine->measurement:'-'),
                ];
                $totalWeight+=$pLine->weight;
            endforeach;
            $linesData[$k]['totalWeight'] = $totalWeight;
        endforeach;

        return $this->render('print/pack',['model'=>$model,'pagesData'=>$linesData,'printer'=>$printer]);
        
    }


    private function renderLinesPrint($preparedLines)
    {
        $res = [];
        // var_dump($preparedLines);
        foreach($preparedLines as $k=>$l):
            $res[$k]=[
                'qty'=>'<div style="float:left;width:10mm;">'.($l['no'] ? $l['no']:'&nbsp;').'</div><div>'.floatval($l['qty']).' '.$l['uom'].'</div><div style="clear:both;"></div>',
                
                'part_no'=>$l['part_no']
            ];

            if(isset($l['name2'])){
                $res[$k]['name'] = $l['name2'];
            }else{
                $res[$k]['name'] = $l['name'];
            }

            // if PRODUCT IS SET TYPE
            if(array_key_exists('set', $l)){
                $res[$k]['name'].='<br/>Consist Of : <ul style="margin:0;">';
                foreach($l['set'] as $set){
                    $res[$k]['name'] .= '<li>'.$set['name'].'</li>';
                    if(array_key_exists('batches', $set) && count($set['batches'])>=1):
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
        /*echo '----------';
        var_dump($res);*/

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
                        'name2'=>$moveDest->name,
                        'desc'=>$moveDest->desc,
                        'set'=>[
                            $this->prepareSetPrint($line),
                        ],
                        'part_no'=>$moveDest->product->default_code,
                    ];

                   

                }
                /*var_dump($line->product->name_template);
                if($line->product->superNotes):
                    foreach($line->product->superNotes as $notes):
                        if($notes->show_in_do_line && isset($res[$moveDest->id]['name'])) $res[$moveDest->id]['name'].='<br/>'.$notes->template_note; #SHOW ETRA NOTES PRODUCT INTO LINE
                    endforeach;
                endif;*/
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
                    'qty'=>$line->product_qty,
                    'uom'=>(isset($line->productUom->name) ? $line->productUom->name:'-'),
                    'name'=>nl2br($line->name),
                    'part_no'=>(isset($line->product->default_code) ? $line->product->default_code:'-')
                ];
        }

        if($line->product->superNotes):
            foreach($line->product->superNotes as $notes):
                if($notes->show_in_do_line) $res['name'].='<br/>'.$notes->template_note; #SHOW ETRA NOTES PRODUCT INTO LINE
            endforeach;
        endif;

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


    // METHOD TO PRINT SET PRODUCT
    // IT A CONSIST OF PART
    private function prepareSetPrint($line){
        $res =  [
            'qty'=>$line->product_qty,
            'uom'=>$line->productUom->name,
            'name'=>($line->name ? nl2br($line->name):$line->product->name),
            'batches'=>$this->prepareBatches($line),
            'part_no'=>$line->product->default_code,
        ];

        if($line->product->superNotes):
            foreach($line->product->superNotes as $note):
                $res['name'].='<br/>'.$note->template_note;
            endforeach;
        endif;

        return $res;
    }
}
