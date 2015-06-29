<?php
namespace app\controllers;
use Yii;
use app\models\ResPartner;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

class ResPartnerController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionExportCsv($id)
    {
    	$this->layout = 'export';
    	$partner = ResPartner::find()->where(['id' =>$id])->one();
    	return $this->render('report/exportcsv',['model'=>$partner]);	
    }

    public function actionExportCsvTree()
    {
    	$this->layout = 'export';
    	$query = new Query; 
    	$query
     		->select ('
     				npwp,
     				name,
                    street,
                    phone,
                    zip')
     		->from('res_partner')
     		->where(['id' =>explode(',',$_GET['id'])]);
    	return $this->render('report/exportcsvtree',['model'=>$query->all()]);	
    }

}
