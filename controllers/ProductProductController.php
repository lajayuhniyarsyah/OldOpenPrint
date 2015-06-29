<?php

namespace app\controllers;
use Yii;
use app\models\ProductProduct;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
class ProductProductController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionExportCsv($id)
    {
    	$this->layout = 'export';
    	$product = ProductProduct::find()->where(['id' =>$id])->one();
    	return $this->render('report/exportcsv',['model'=>$product]);	
    }

    public function actionExportCsvTree()
    {
    	$this->layout = 'export';
    	$query = new Query; 
    	$query
     		->select ('
     				default_code,
     				name_template')
     		->from('product_product')
     		->where(['id' =>explode(',',$_GET['id'])]);
    	return $this->render('report/exportcsvtree',['model'=>$query->all()]);	
    }
}
