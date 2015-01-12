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
use yii\db\QueryBuilder;
use yii\db\Command;

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

     public function actionTransaksiAccount($account,$from,$to)
     {
     	$this->layout = 'report';
     	$query = new Query;

     	if ($account == "False"){
     		$query
     		->select ('aml.account_id as account_id')
     		->distinct('aml.account_id')
     		->from('account_move_line as aml')
     		->where(['>=','aml.date',$from])
     		->andWhere(['<=','aml.date',$to])
			->addOrderBy(['aml.account_id' => SORT_ASC]);
		
			return $this->render('transaksiaccount',['data'=>$query->all(), 'from' =>$from, 'to'=>$to, 'account'=>$account]);

     	}else{
			return $this->render('transaksiaccount',['account'=>$account, 'from' =>$from, 'to'=>$to]);
     	}

     	
     }

     public function actionAgingArSummary()
     {
     	$this->layout = 'report';
     	$from ='2014-08-15';
     	$query = new Query;
		     		$query
		     		->select ('aml.partner_id as partner_id, partner.name as name')
		     		->distinct('aml.partner_id')
		     		->from('account_move_line as aml')
		     		->join('LEFT JOIN','res_partner as partner','partner.id=aml.partner_id')
		     		->where(['<=','aml.date',$from])
		     		->andWhere(['customer'=>TRUE]);

     	return $this->render('agingarsummary',['data'=>$query->all(), 'date'=>$from]);
     }

     public function actionTurnOver($id)
     {
     	$this->layout = 'stockmanagement';
     	
     	$query = new Query;
     			$query
				->select(
	    				'
	    				 s.type as jenis,
	    				 m.date as date,
	    				 s.lbm_no as lbm,
	    				 s.name as no_int,
	    				 p.default_code as part_number,
	    				 p.name_template as name_template,
	    				 m.product_qty as qty,
	    				 u.name as uom,
	    				 l.name as location,
	    				 sl.name as desc_location,       
	    				 r.name as partner,
	    				 s.name as type,
	    				 s.lbm_no as lbm,
	    				 s.cust_doc_ref as ref_cus,
	    				 dn.name as dn,
	    				 op.name as op,
	    				 s.origin as ori,
	    				 m.origin as origin,
	    				 m.state as state,
	    				 m.name as product_name
	    				')
			    ->from('stock_move as m')
			    ->join('LEFT JOIN','stock_picking as s','s.id=m.picking_id')
			    ->join('LEFT JOIN','purchase_order as po','po.id=s.purchase_id')
			    ->join('LEFT JOIN','product_product as p','p.id=m.product_id')
			    ->join('LEFT JOIN','product_template as pt','pt.id=m.product_id')
			    ->join('LEFT JOIN','delivery_note as dn','dn.id=s.note_id')
			    ->join('LEFT JOIN','order_preparation as op','op.id=dn.prepare_id')
			    ->join('JOIN','product_uom as u','u.id=m.product_uom')
			    ->join('JOIN','res_partner as r','r.id=m.partner_id')
			    ->join('JOIN','stock_location as l','m.location_id=l.id')
			    ->join('JOIN','stock_location as sl','m.location_dest_id=sl.id')
			    ->join('LEFT JOIN','stock_production_lot as batch','batch.id=m.prodlot_id')
			    ->join('LEFT JOIN','product_pricelist as ppl','ppl.id = po.pricelist_id')
			    ->where(['m.product_id'=>$id])
			    ->andWhere(['m.state'=>'done'])
			    ->addOrderBy(['m.date' => SORT_DESC]);

			$data = $query->all();
			// echo '<pre>';
			// print_r($query->all()[0]['product_name']);
			// echo '</pre>';
     	return $this->render('turnover',['data'=>$data,'nameproduct'=>$data[0]['product_name']]);	
     }


     public function actionSaldoAkhir()
     {
     	$query = new Query;
     	$command = $query
     			 ->createCommand("
     			 	SELECT
                        min(sm.id) as id, 
                        date_trunc('day', sm.date) as date,
                        to_char(date_trunc('day',sm.date), 'YYYY') as year,
                        to_char(date_trunc('day',sm.date), 'MM') as month,
                        to_char(date_trunc('day',sm.date), 'YYYY-MM-DD') as day,
                        avg(date(sm.date)-date(sm.create_date)) as day_diff,
                        avg(date(sm.date_expected)-date(sm.create_date)) as day_diff1,
                        avg(date(sm.date)-date(sm.date_expected)) as day_diff2,
                        sm.location_id as location_id,
                        sm.picking_id as picking_id,
                        sm.company_id as company_id,
                        sm.location_dest_id as location_dest_id,
                        sum(sm.product_qty) as product_qty,
                        sum(
                            (CASE WHEN sp.type in ('out') THEN
                                     (sm.product_qty * pu.factor / pu2.factor)
                                  ELSE 0.0 
                            END)
                        ) as product_qty_out,
                        sum(
                            (CASE WHEN sp.type in ('in') THEN
                                     (sm.product_qty * pu.factor / pu2.factor)
                                  ELSE 0.0 
                            END)
                        ) as product_qty_in,
                        sm.partner_id as partner_id,
                        sm.product_id as product_id,
                        sm.state as state,
                        sm.product_uom as product_uom,
                        pt.categ_id as categ_id ,
                        coalesce(sp.type, 'other') as type,
                        sp.stock_journal_id AS stock_journal,
                        sum(
                            (CASE WHEN sp.type in ('in') THEN
                                     (sm.product_qty * pu.factor / pu2.factor) * pt.standard_price
                                  ELSE 0.0 
                            END)
                            -
                            (CASE WHEN sp.type in ('out') THEN
                                     (sm.product_qty * pu.factor / pu2.factor) * pt.standard_price
                                  ELSE 0.0 
                            END)
                        ) as value
                    FROM
                        stock_move sm
                        LEFT JOIN stock_picking sp ON (sm.picking_id=sp.id)
                        LEFT JOIN product_product pp ON (sm.product_id=pp.id)
                        LEFT JOIN product_uom pu ON (sm.product_uom=pu.id)
                          LEFT JOIN product_uom pu2 ON (sm.product_uom=pu2.id)
                        LEFT JOIN product_template pt ON (pp.product_tmpl_id=pt.id)
                    GROUP BY
                        coalesce(sp.type, 'other'), date_trunc('day', sm.date), sm.partner_id,
                        sm.state, sm.product_uom, sm.date_expected,
                        sm.product_id, pt.standard_price, sm.picking_id,
                        sm.company_id, sm.location_id, sm.location_dest_id, pu.factor, pt.categ_id, sp.stock_journal_id,
                        year, month, day
     			 ");
     	$rows = $command->queryAll();
     	echo '<pre>';
     	print_r($rows);
     	echo '</pre>';
     	return $this->render('saldoakhirproduct');		
     }
}

?>