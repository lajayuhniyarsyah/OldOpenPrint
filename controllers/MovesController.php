<?php

namespace app\controllers;

use Yii;
use app\models\StockPicking;
use app\models\StockPickingSearch;
use app\models\StockLocation;
use app\models\StockMove;
use app\models\StockMoveSearch;
use app\models\InternalMoveRequest;
use app\models\InternalMoveRequestLine;
use app\models\InternalMove;
use app\models\InternalMoveLine;
use app\models\InternalMoveLineDetail;
use app\models\MrpBom;
use app\models\MrpBomSearch;
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

	public function actionProductSet()
	{
		return $this->render('Productset');
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
			throw new NotFoundHttpException('The requested page does not exist. Location Rules Not Valid. Please Contact System Adminstrator');
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
	protected function findModel($id,$model=0)
	{
		switch ($model) {
			case 1:
				$modelN = 'StockMove';
				if (($model = StockMove::findOne($id)) !== null)
				{
					return $model;
				}
				else
				{
					throw new NotFoundHttpException('The requested page does not exist.');
				}
				break;
			
			default:
				# code...
				$modelN = 'StockPicking';
				if (($model = StockPicking::findOne($id)) !== null)
				{
					return $model;
				}
				else
				{
					throw new NotFoundHttpException('The requested page does not exist.');
				}
				break;
		}

		
	}

	public function actionViewMoveChilds($id){
		$searchModel = new StockMoveSearch();
		$dataProvider = $searchModel->searchChild($id);


		$move = $this->findModel($id,1);
		return $this->render('view_move_childs',['model'=>$move,'dataProvider'=>$dataProvider,'filterModel'=>$searchModel]);
	}

	public function actionGenerateProductSet($id,$product_id){
		$dataMove = StockMove::find()->where(['id'=>$id])->one();
		$bom = MrpBom::find()->where(['product_id'=>$product_id,'type'=>'phantom'])->one();
		if(!$bom){
			throw new NotFoundHttpException('This Product Not Setted Into Phantom BOM');
		}

		$searchModel = new MrpBomSearch();
		$dataProvider = $searchModel->searchBom($bom->id);
		foreach($dataProvider->getModels() as $model){
			$newMove = new StockMove();
			$newMove->create_uid = $dataMove->create_uid;
			$newMove->create_date = $dataMove->create_date;
			$newMove->date = $dataMove->create_date;
			$newMove->write_date = $dataMove->write_date;
			$newMove->write_uid = $dataMove->write_uid;
			$newMove->origin = $dataMove->origin;
			$newMove->product_uos_qty = $dataMove->product_uos_qty;
			$newMove->date_expected = $dataMove->date_expected;
			$newMove->product_uom = $model->product_uom;
			$newMove->move_dest_id = $dataMove->id;
			$newMove->product_qty = $dataMove->product_qty * $model->product_qty;
			$newMove->product_uos = $model->product_uom;
			$newMove->partner_id = $dataMove->partner_id;
			$newMove->product_id = $model->product_id;
			$newMove->location_id = $dataMove->location_id;
			$newMove->company_id = $dataMove->company_id;
			$newMove->picking_id = $dataMove->picking_id;
			$newMove->state = $dataMove->state;
			$newMove->location_dest_id = $dataMove->location_dest_id;
			$newMove->tracking_id = $dataMove->tracking_id;
			$newMove->product_packaging = $dataMove->product_packaging;
			$newMove->purchase_line_id = $dataMove->purchase_line_id;
			$newMove->sale_line_id = $dataMove->sale_line_id;
			$newMove->name = $model->name;
			$newMove->desc = $model->name;
			$newMove->no = $dataMove->no;
			$newMove->weight_uom_id=3;
			$newMove->save();
		}

		$stockmove = StockMove::findOne($id);
		$stockmove->picking_id = '';
		$stockmove->location_dest_id = 12;
		$stockmove->update();

		return $this->redirect(['view-move-childs', 'id' => $id]);
	}


	private function loadInternalMove($id)
	{
		$model = InternalMove::findOne($id);

		if($model)
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/**
	 * [actionPrintInternalMovePreparation description]
	 * @param  Integer
	 * @param  [type]
	 * @return [type]
	 */
	public function actionPrintInternalMovePreparation($id,$uid)
	{
		$this->layout = 'printout';
		
		$model = $this->loadInternalMove($id);
		// var_dump($model);
		$data = [];
		foreach($model->internalMoveLines as $line):
			$no = 0;
			$qty = "";
			$desc = "";
			$code = "";
			if($line->internalMoveLineDetails):
				foreach($line->internalMoveLineDetails as $detail):
					$no = $detail->no;
					$qty = $detail->qty.' '.$detail->uom->name;
					$desc = $detail->product->name_template;
					if($detail->stock_prod_lot_id):
						$desc .= '<br/>B/N : '.$detail->stockProdLot->name.'.';
						if($detail->desc):
							$desc .= '&nbsp;'.$detail->desc;
						endif;
						
					endif;
					// if super notes
					if($detail->product->superNotes):
						foreach($detail->product->superNotes as $sNote):
							$desc .= '<br/>'.$sNote->template_note;
						endforeach;
					endif;
					$code = $detail->product->default_code;
					$data[]=[$no,$qty,$desc,$code];
				endforeach;
			else:
				
				$no = $line->no;
				$qty = $line->qty.' '.$line->uom->name;
				$desc = $line->product->name_template;
				$code = $line->product->default_code;


				if($line->product->superNotes):
					foreach($line->product->superNotes as $sNote):
						if($sNote->show_in_do_line):
							$desc .= '<br/>'.$sNote->template_note;
						endif;
					endforeach;
				endif;

				$data[]=[$no,$qty,$desc,$code];
			endif;

			
		endforeach;
		// var_dump($data);
		return $this->render('print/internal_move_preparation',['model'=>$model,'data'=>$data]);
	}

	
	public function actionPrintInternalMove($id,$uid)
	{
		$this->layout='printout';
		$model = $this->loadInternalMove($id);

		$lines = [];

		foreach($model->internalMoveLines as $line):
			$lines[] = $this->preparePrintInternalMoveLine($line);
		endforeach;
		
		// var_dump($lines);
		return $this->render('print/internal_move_note',['model'=>$model,'lines'=>$lines]);
	}

	private function preparePrintInternalMoveLine($line)
	{
		$productField = $line->product->name_template.($line->desc ? "<br/>".$line->desc:null);

		$product = $line->product;
		$sNoteLine = False;
		$sNoteDetail = False;
		if($product->superNotes):
			foreach($product->superNotes as $superNote):
				$sNoteLine .= "<br/>".$superNote->template_note;
			endforeach;
		endif;
		// IF HAS DETAILS
		if($line->internalMoveLineDetails):
			$detailField = "";
			$productField .="<br/>Consist Of :<ul>";
			$sNoteLine = "";
			foreach($line->internalMoveLineDetails as $detail):
				$sNoteDetail = "";
				if($detail->product->superNotes):
					foreach($detail->product->superNotes as $superNoteD):
						$sNoteDetail .= "<br/>".$superNoteD->template_note;
					endforeach;
				endif;

				$detailField.="<li>";
				$detailField.=$detail->product->name_template.' '.($detail->desc ? '<br/>'.$detail->desc.($detail->stock_prod_lot_id ? "<br/>B/N :".$detail->stockProdLot->name." - ".$detail->qty." ".$detail->uom->name:null):null).($sNoteDetail ? $sNoteDetail:null);
				$detailField.="</li>";
			endforeach;
			$productField.=$detailField;
			$productField.="</ul>";

		endif;
		
		$res = [
			'no'=>$line->no,
			'qty'=>$line->qty.' '.$line->uom->name,
			'product'=>$productField.($sNoteLine ? $sNoteLine:null),
			'part_no'=>$line->product->default_code,
		];

		return $res;
	}
}
