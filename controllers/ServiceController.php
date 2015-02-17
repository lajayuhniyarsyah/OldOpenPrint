<?php

namespace app\controllers;

use Yii;
use app\models\AccountInvoice;
use app\models\AccountInvoiceSearch;
use app\models\ResUsers;
use app\models\ResPartner;
use app\models\ResCurrency;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\db\Query;

class ServiceController extends Controller{
	public function behaviors()
	{
		return [
			'access'=>[
				'class'=>\yii\filters\AccessControl::className(),
				'rules'=>[
					[
						'allow'=>true,
						'roles'=>['@']
					],
					[
						'allow'=>false,
						'roles'=>['?']
					]
				]
			]
		];
	}


	/**
	 * Get All User List for Searching with ajax in select2 widget
	 * @param  char $search 	query search
	 * @param  integer $id 		id of user
	 * @return array         	['user_id'=>'User Profile Name']
	 **/

	public function actionSearchUser($search = null, $id = null) {
		$out = ['more' => false];
		$q = new Query;
		if (!is_null($search)) {

			$q->select('usr.id, prf.name as text')
				->from(ResUsers::tableName().' as usr')
				->leftJoin(ResPartner::tableName().' prf', 'prf.id=usr.partner_id')
				->where('LOWER(prf.name) LIKE :search OR LOWER(usr.login) like :search')
				->addParams([':search'=>'%'.strtolower($search).'%']);
			$users = $q->createCommand()->queryAll();
			
			$out['results'] = array_values($users);
		}
		elseif ($id > 0) {
			
			$out['results'] = ['id' => $id, 'text' => ResUsers::find()->where(['id'=>$id])->with('partner')->one()->partner->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo \yii\helpers\Json::encode($out);
	}

	public function actionSearchCurrency($search=null,$id=null){
		$out = ['more' => false];
		$q = new Query;
		if (!is_null($search)) {

			$q->select('cur.id, cur.name as text')
				->from(ResCurrency::tableName().' as cur')
				->where('LOWER(cur.name) LIKE :search')
				->addParams([':search'=>'%'.strtolower($search).'%']);
			$users = $q->createCommand()->queryAll();
			
			$out['results'] = array_values($users);
		}
		elseif ($id > 0) {
			
			$out['results'] = ['id' => $id, 'text' => ResCurrency::find()->where(['id'=>$id])->with('partner')->one()->partner->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo \yii\helpers\Json::encode($out);
	}

	/**
	 * Action Ajax for searc customer list in select2 widget
	 * @param  [type] $search [description]
	 * @param  [type] $id     [description]
	 * @return [json]         JSON['customer_id'=>'name']
	 */
	public function actionSearchCustomer($search=null,$id=null){
		$out = ['more' => false];
		$q = new Query;
		if (!is_null($search)) {

			$q->select('p.id, p.name as text')
				->from(ResPartner::tableName().' as p')
				->where('LOWER(p.name) LIKE :search')
				->andWhere('employee is false and customer is true')
				->addParams([':search'=>'%'.strtolower($search).'%']);
			$users = $q->createCommand()->queryAll();

			$out['results'] = array_values($users);
		}
		elseif ($id > 0) {
			
			$out['results'] = ['id' => $id, 'text' => ResPartner::find()->where(['id'=>$id])->one()->name];
		}
		else {
			$out['results'] = ['id' => 0, 'text' => 'No matching records found'];
		}
		echo \yii\helpers\Json::encode($out);
	}
}
?>