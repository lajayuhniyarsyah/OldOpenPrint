<?php
namespace app\controllers;
use Yii;
use app\models\StockPicking;
use app\models\StockPickingSearch;
use app\models\StockLocation;
use app\models\StockMove;
use app\models\StockMoveSearch;
use app\models\MrpBom;
use app\models\MrpBomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
class ReportAccountingController extends Controller
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

    public function actionStockMove($jenis,$from,$to)
    {
    	$this->layout = 'report';
    	$jenisreport=$_GET['jenis'];
    	$query = new Query;
    	if ($jenisreport=="del"){
	    		$query
	    		->select(
	    				'
	    				 dn.create_date as cretae_date, 
	    				 dn.tanggal as tanggal,
	    				 dn.name as dn_no,
	    				 op.name as no_op,
	    				 p.default_code as part_number,
	    				 p.name_template as name_template,
	    				 sm.name as name_input,
	    				 sm.product_qty as qty,
	    				 u.name as uom,
	    				 batch.name as batch,
	    				 sol.price_unit as price,
	    				 ppl.name as pricelist,          
	    				 r.name as partner,
	    				 dn.poc as poc,
	    				 so.name as so_no,
	    				 sp.state as state,
	    				')
			    ->from('stock_move as sm')
			    ->join('JOIN','stock_picking as sp','sm.picking_id=sp.id')
			    ->join('JOIN', 'order_preparation as op', 'op.picking_id=sp.id')
			    ->join('LEFT JOIN', 'delivery_note as dn', 'dn.prepare_id=op.id')
			    ->join('LEFT JOIN', 'product_product as p', 'p.id=sm.product_id')
			    ->join('LEFT JOIN','sale_order_line as sol','sol.id=sm.sale_line_id')
			    ->join('LEFT JOIN', 'sale_order as so', 'so.id=op.sale_id')
			    ->join('JOIN', 'product_uom as u', 'u.id=sm.product_uom')
			    ->join('JOIN', 'res_partner as r', 'r.id=dn.partner_id')
			    ->join('LEFT JOIN', 'stock_production_lot as batch', 'batch.id=sm.prodlot_id')
			    ->join('JOIN', 'product_pricelist as ppl', 'ppl.id = so.pricelist_id')
			    ->where(['>=','dn.tanggal',$from])
			    ->andWhere(['<=','dn.tanggal',$to])
			    ->andWhere(['not', ['p.default_code' => 'DUMMY01']])
			    ->orderBy('dn.tanggal ASC');
			    

    	}else{
	    		$query
	    		->select(
	    				'
	    				 s.type as jenis,
	    				 s.date_done as date_done,
	    				 s.lbm_no as lbm,
	    				 p.default_code as part_number,
	    				 p.name_template as name_template,
	    				 m.name as name_input,
	    				 m.product_qty as qty,
	    				 u.name as uom,
	    				 batch.name as batch,
	    				 m.price_unit as price,
	    				 ppl.name as pricelist,   
	    				 l.name as location,
	    				 sl.name as desc_location,       
	    				 r.name as partner,
	    				 s.name as type,
	    				 po.name as po,
	    				 s.origin as origin,
	    				 s.state as state,
	    				')
			    ->from('stock_move as m')
			    ->join('LEFT JOIN','stock_picking as s','s.id=m.picking_id')
			    ->join('LEFT JOIN','purchase_order as po','po.id=s.purchase_id')
			    ->join('LEFT JOIN','product_product as p','p.id=m.product_id')
			    ->join('LEFT JOIN','product_template as pt','pt.id=m.product_id')
			    ->join('JOIN','product_uom as u','u.id=m.product_uom')
			    ->join('JOIN','res_partner as r','r.id=m.partner_id')
			    ->join('JOIN','stock_location as l','m.location_id=l.id')
			    ->join('JOIN','stock_location as sl','m.location_dest_id=sl.id')
			    ->join('LEFT JOIN','stock_production_lot as batch','batch.id=m.prodlot_id')
			    ->join('LEFT JOIN','product_pricelist as ppl','ppl.id = po.pricelist_id')
			    ->where(['>=','s.date_done',$from])
			    ->andWhere(['<=','s.date_done',$to])
			    ->andWhere(['like','s.name','IN' ])
			    ->andWhere(['s.state'=>'done' ])
			    ->andWhere(['pt.sale_ok'=>TRUE ])
			    ->andWhere(['not', ['p.default_code' => null]])
			    ->andWhere(['not', ['p.default_code' => 'DUMMY01']]);
    	}
    	return $this->render('stockmove',['data'=>$query->all(), 'jenis'=>$jenisreport, 'from'=>$from , 'to'=>$to]);
    }

     public function actionTransaksiAccount()
     {
     	$from='2014-10-01';
     	$to='2014-10-30';
     	$query = new Query;
     		$query
     		->select('
     					aml.id as id,
     					am.ref as ref,
     					ac.code as code,
     					ac.name as account,
     					aml.name as keterangan,
     					aml.debit as debit,
     					aml.credait as credit
     				 ')
     		->from('account_move_line as aml')
     		->join('LEFT JOIN','account_account as ac','ac.id=aml.account_id')
     		->join('LEFT JOIN','account_move as am','am.id=aml.move_id')
     		->where(['>=','aml.date',$from])
     		->andWhere(['<=','aml.date',$to])
     		->limit(100);
     	echo '<pre>';
     	print_r($query->all());
     	echo '</pre>';
     	return $this->render('transaksiaccount',['data'=>$query]);
     }
}

?>