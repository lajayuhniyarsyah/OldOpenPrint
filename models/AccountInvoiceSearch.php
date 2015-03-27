<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AccountInvoice;

/**
 * AccountInvoiceSearch represents the model behind the search form about `app\models\AccountInvoice`.
 */
class AccountInvoiceSearch extends AccountInvoice
{
	public $start_date,$end_date,$sales_ids,$group_ids;
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'create_uid', 'write_uid', 'account_id', 'company_id', 'currency_id', 'partner_id', 'fiscal_position', 'user_id', 'partner_bank_id', 'payment_term', 'journal_id', 'period_id', 'move_id', 'commercial_partner_id', 'approver'], 'integer'],
			[['create_date', 'write_date', 'origin', 'date_due', 'reference', 'supplier_invoice_number', 'number', 'reference_type', 'state', 'type', 'internal_number', 'move_name', 'date_invoice', 'name', 'comment', 'kmk', 'faktur_pajak_no', 'kwitansi','start_date','end_date'], 'safe'],
			[['check_total', 'amount_tax', 'residual', 'amount_untaxed', 'amount_untaxed', 'pajak', 'kurs'], 'number'],
			[['reconciled', 'sent'], 'boolean'],
			[['sales_ids'],'checkSales'],
			[['group_ids'],'checkGroup']
		];
	}

	public function checkSales($attribute,$params){
		foreach($this->$attribute as $salesId){
			$query = new \yii\db\Query;
			$query->select('id')
				->from(ResUsers::tableName())
				->where('id = :salesIds')
				->addParams([':salesIds'=>$salesId]);
			if(!$query->exists()){
				$this->addError($attribute,'Sales Man did you search is not exist for sales man id '.$salesId);
			}
		}
	}
	public function checkGroup($attribute,$params){
		foreach($this->$attribute as $gid){
			$query = new \yii\db\Query;
			$query->select('id')
				->from(GroupSales::tableName())
				->where('id = :gid')
				->addParams([':gid'=>$gid]);
			if(!$query->exists()){
				$this->addError($attribute,'Sales Man did you search is not exist for group id '.$gid);
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function searchPaymentStatus($groupByCustomer=false,$status=null){
		$conn = Yii::$app->db;
		$andUserIds="";
		if(count($this->sales_ids)){
			$implUid = implode(',', $userIds);
			$andUserIds = " AND ai.user_id in ($implUid)";
		}

		if($this->date_invoice){
			$dateInvoiceFilter = $this->date_invoice;
			if(preg_match('/To/', $this->date_invoice))
			{
				// if date range
				$expl = explode('To', $this->date_invoice);
				$start_date=$expl[0];
				$end_date=$expl[1];
			}
		}else{
			$start_date=$this->start_date;
			if(!$this->start_date){
				$start_date = '2014-07-01';
			}
			$end_date = $this->end_date;
			if(!$this->end_date){
				$end_date = date('Y-m-d');
			}

		}
		$andDateRange = " AND ai.date_invoice BETWEEN '{$start_date}' AND '{$end_date}'";
		
		$groupSection = 'ai_rated.status';
		$selectSection = 'ai_rated.status,
				SUM(ai_rated.total_rated) AS subtotal';
		$orderSection = "ai_rated.status ASC";
		$joinSection = "";
		$whereSection = "";
		if($groupByCustomer){
			$selectSection = 'res_partner.name,
				ai_rated.status,
				SUM(ai_rated.total_rated) AS subtotal';
			$groupSection = 'res_partner.name, ai_rated.status';
			$orderSection = "res_partner.name ASC";
			$joinSection = "JOIN res_partner ON ai_rated.partner_id=res_partner.id";
			if($status){
				$whereSection = "WHERE ai_rated.status = 'Canceled'";
			}
		}
		$sql = <<< SQL
			SELECT
				{$selectSection}
			FROM
				(SELECT
					ai.*,
					(CASE WHEN state = 'cancel' THEN 'Canceled' ELSE (CASE WHEN state='paid' THEN 'Paid' ELSE 'Waiting For Payment' END) END) AS status,
					(
						CASE WHEN rcr.rating IS NULL THEN( 
							( CASE WHEN (
								CASE WHEN rcr.rating IS NULL AND rc.id=13 THEN 1 ELSE CASE WHEN rcr.rating IS NULL THEN 0 END END
							) = 0 THEN (
								SELECT rating FROM res_currency_rate WHERE ai.currency_id=rc.id AND NAME < ai.date_invoice ORDER BY NAME DESC LIMIT 1
							) * ai.amount_untaxed ELSE (1*ai.amount_untaxed) END ) 
						) 
						ELSE (rcr.rating*amount_untaxed) END
					) AS total_rated
				FROM "account_invoice" "ai"
				JOIN res_currency AS rc ON ai.currency_id=rc.id 
				LEFT OUTER JOIN res_currency_rate AS rcr ON rcr.currency_id=rc.id AND rcr.name = ai.date_invoice 
				WHERE 
					type in ('out_invoice')
					{$andUserIds}
					{$andDateRange}
				) AS ai_rated
			{$joinSection}
			{$whereSection}
			GROUP BY
				{$groupSection}
			ORDER BY
				{$orderSection}
SQL;
		return $conn->createCommand($sql)->queryAll();

	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params=null,$type=null,$dateRange=null,$groupBy=null)
	{

		$query = AccountInvoice::find();
		
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort'  => [
				'defaultOrder'=>[
					'date_invoice'=>SORT_DESC,
				]
			]
		]);

		/*if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}*/

		$dateInvoiceFilter = $this->date_invoice;
		if(preg_match('/To/', $this->date_invoice))
		{
			// if date range
			$dateInvoiceFilter = 'BETWEEN :date_from AND :date_to';
			$expl = explode('To', $this->date_invoice);
			$query->where(['between','date_invoice',$expl[0],$expl[1]]);
		}


		$query->andFilterWhere([
			'id' => $this->id,
			'create_uid' => $this->create_uid,
			'create_date' => $this->create_date,
			'write_date' => $this->write_date,
			'write_uid' => $this->write_uid,
			'date_due' => $this->date_due,
			'check_total' => $this->check_total,
			'account_id' => $this->account_id,
			'company_id' => $this->company_id,
			'currency_id' => $this->currency_id,
			'partner_id' => $this->partner_id,
			'fiscal_position' => $this->fiscal_position,
			'user_id' => $this->user_id,
			'partner_bank_id' => $this->partner_bank_id,
			'payment_term' => $this->payment_term,
			'journal_id' => $this->journal_id,
			'amount_tax' => $this->amount_tax,
			'reconciled' => $this->reconciled,
			'residual' => $this->residual,
			// 'date_invoice' => $dateInvoiceFilter,
			'period_id' => $this->period_id,
			'amount_untaxed' => $this->amount_untaxed,
			'move_id' => $this->move_id,
			'amount_untaxed' => $this->amount_untaxed,
			'sent' => $this->sent,
			'commercial_partner_id' => $this->commercial_partner_id,
			'pajak' => $this->pajak,
			'kurs' => $this->kurs,
			'approver' => $this->approver,
		]);

		$query->andFilterWhere(['like', 'origin', $this->origin])
			->andFilterWhere(['like', 'reference', $this->reference])
			->andFilterWhere(['like', 'supplier_invoice_number', $this->supplier_invoice_number])
			->andFilterWhere(['like', 'number', $this->number])
			->andFilterWhere(['like', 'reference_type', $this->reference_type])
			->andFilterWhere(['like', 'state', $this->state])
			->andFilterWhere(['like', 'type', $this->type])
			->andFilterWhere(['like', 'internal_number', $this->internal_number])
			->andFilterWhere(['like', 'move_name', $this->move_name])
			->andFilterWhere(['like', 'name', $this->name])
			->andFilterWhere(['like', 'comment', $this->comment])
			->andFilterWhere(['like', 'kmk', $this->kmk])
			->andFilterWhere(['like', 'faktur_pajak_no', $this->faktur_pajak_no])
			->andFilterWhere(['like', 'kwitansi', $this->kwitansi]);

		return $dataProvider;
	}

	/**
	 * Get Summary Invoiced Order
	 * @param  [type] $start_date Invoice date start range. Mus in format Y-m-d. Ex: 2014-11-01
	 * @param  [type] $end_date   Invoice date end range. Mus in format Y-m-d. Ex: 2014-12-31
	 * @return array              result set rows in array
	 */
	public function getSum(){
		$this->validate();
		$userIdsWhere=""; # append 'AND ai.user_id in ()' default to empty string it means not append user id condition
		if(count($this->sales_ids)){
			$userIdsWhere = 'AND ai.user_id in ('.implode(',', $this->sales_ids).')';
		}

		$groupIdsWhere="";
		if(count($this->group_ids)){
			if($userIdsWhere){
				$userIdsWhere = 'AND ('.str_replace('AND ', '', $userIdsWhere).' OR ai.group_id in ('.implode(',', $this->group_ids).'))';
			}else{
				$groupIdsWhere = 'AND ai.group_id in ('.implode(',', $this->group_ids).')';
			}
		}
		$d1 = new \DateTime($this->start_date);
		$y1 = $d1->format('Y');
		$m1 = $d1->format('n');
		$d2 = new \DateTime($this->end_date);
		$y2 = $d2->format('Y');
		$m2 = $d2->format('n');

		// @link http://www.php.net/manual/en/class.dateinterval.php
		$interval = $d2->diff($d1);

		$interval->format('%m months');
		
		
		$periods = [];
		$currM = $m1;
		$currY = $y1;

		// end year = $y2
		// end month = $m2
		$stop = false;
		do {
			if($currM>12)
			{
				$currY++; #next year
				$currM = 1; #reset to jan
			}
			$periods[] = [
				'period_year'=>$currY,
				'period_month'=>$currM
			];
			

			// if month and year is end
			// stop
			if($currY==$y2 and $currM == $m2){
				$stop=true;
			}else{
				$currM++;
			}

		} while(!$stop);
		
		$qSelectMonthly = [];
		foreach($periods as $period):
			$period_year = $period['period_year'];
			$period_month = $period['period_month'];

			$qSelectMonthly[] = "SUM(CASE WHEN grouped_ai.year_invoice = '{$period_year}' AND grouped_ai.month_invoice = {$period_month} THEN summary ELSE 0 END) AS summary_{$period_year}_{$period_month}";
		endforeach;
		$qSelectMonthly = implode(',', $qSelectMonthly);
		
		$conn = \Yii::$app->db;
		$sql = <<<SQL
SELECT 
	grouped_ai.group_name,
	grouped_ai.user_id, 
	p.name as sales_name, 
	{$qSelectMonthly}
FROM (
	SELECT 
		
		ai_rated.year_invoice,
		ai_rated.month_invoice,
		(select "desc" from group_sales as gs where gs.id = ai_rated.group_id) as group_name,
		ai_rated.user_id,
		SUM(ai_rated.total_rated) as summary
		
	FROM
		(SELECT
			ai.id,
			ai.user_id,
			ai.amount_untaxed,
			ai.date_invoice,
			ai.group_id,
			CAST(EXTRACT(MONTH FROM "date_invoice") AS INTEGER) AS month_invoice,
			CAST(EXTRACT(YEAR FROM "date_invoice") AS INTEGER) AS year_invoice,
			rcr.rating,
			
			(
				CASE WHEN rcr.rating IS NULL THEN( 
					( CASE WHEN (
						CASE WHEN rcr.rating IS NULL AND rc.id=13 THEN 1 ELSE CASE WHEN rcr.rating IS NULL THEN 0 END END
					) = 0 THEN (
						SELECT rating FROM res_currency_rate WHERE ai.currency_id=rc.id AND NAME < ai.date_invoice ORDER BY NAME DESC LIMIT 1
					) * ai.amount_untaxed ELSE (1*ai.amount_untaxed) END ) 
				) 
				ELSE (rcr.rating*amount_untaxed) END
			) AS total_rated
		FROM
			account_invoice AS ai
		JOIN res_currency AS rc ON ai.currency_id=rc.id 
		LEFT OUTER JOIN res_currency_rate AS rcr ON rcr.currency_id=rc.id AND rcr.name = ai.date_invoice 
		WHERE
			ai.date_invoice BETWEEN '{$this->start_date}' AND '{$this->end_date}'
			AND ai.type='out_invoice'
			AND ai.state not in ('cancel','draft')
			{$userIdsWhere}
			{$groupIdsWhere}
		) AS ai_rated
	GROUP BY
		ai_rated.year_invoice,
		ai_rated.month_invoice,
		group_name,
		ai_rated.user_id
	ORDER BY 
		ai_rated.year_invoice ASC,
		ai_rated.month_invoice ASC
	) as grouped_ai
LEFT OUTER JOIN res_users AS rusr ON grouped_ai.user_id = rusr.id 
LEFT OUTER JOIN res_partner as p ON p.id = rusr.partner_id 
GROUP BY
	grouped_ai.group_name,
	grouped_ai.user_id
	,p.name
ORDER BY
	grouped_ai.group_name,
	p.name ASC
SQL;
		// echo '<text>'.$sql.'</text>';
		$cmd = $conn->createCommand($sql);
		$res = $cmd->queryAll();
		return $res;
	}

	public function getSumGroup(){
		$this->validate();
		$userIdsWhere=""; # append 'AND ai.user_id in ()' default to empty string it means not append user id condition
		if(count($this->sales_ids)){
			$userIdsWhere = 'AND ai.user_id in ('.implode(',', $this->sales_ids).')';
		}

		$groupIdsWhere="";
		if(count($this->group_ids)){
			if($userIdsWhere){
				$userIdsWhere = 'AND ('.str_replace('AND ', '', $userIdsWhere).' OR ai.group_id in ('.implode(',', $this->group_ids).'))';
			}else{
				$groupIdsWhere = 'AND ai.group_id in ('.implode(',', $this->group_ids).')';
			}
			
		}
		// var_dump($groupIdsWhere);
		$d1 = new \DateTime($this->start_date);
		$y1 = $d1->format('Y');
		$m1 = $d1->format('n');
		$d2 = new \DateTime($this->end_date);
		$y2 = $d2->format('Y');
		$m2 = $d2->format('n');

		// @link http://www.php.net/manual/en/class.dateinterval.php
		$interval = $d2->diff($d1);

		$interval->format('%m months');
		
		
		$periods = [];
		$currM = $m1;
		$currY = $y1;

		// end year = $y2
		// end month = $m2
		$stop = false;
		do {
			if($currM>12)
			{
				$currY++; #next year
				$currM = 1; #reset to jan
			}
			$periods[] = [
				'period_year'=>$currY,
				'period_month'=>$currM
			];
			

			// if month and year is end
			// stop
			if($currY==$y2 and $currM == $m2){
				$stop=true;
			}else{
				$currM++;
			}

		} while(!$stop);
		
		$qSelectMonthly = [];
		foreach($periods as $period):
			$period_year = $period['period_year'];
			$period_month = $period['period_month'];

			$qSelectMonthly[] = "SUM(CASE WHEN grouped_ai.year_invoice = '{$period_year}' AND grouped_ai.month_invoice = {$period_month} THEN summary ELSE 0 END) AS summary_{$period_year}_{$period_month}";
		endforeach;
		$qSelectMonthly = implode(',', $qSelectMonthly);
		
		$conn = \Yii::$app->db;
		$sql = <<<SQL
SELECT 
	grouped_ai.group_name as sales_name,
	{$qSelectMonthly}
FROM (
	SELECT 
		
		ai_rated.year_invoice,
		ai_rated.month_invoice,
		(select "desc" from group_sales as gs where gs.id = ai_rated.group_id) as group_name,
		SUM(ai_rated.total_rated) as summary
		
	FROM
		(SELECT
			ai.id,
			ai.amount_untaxed,
			ai.date_invoice,
			ai.group_id,
			CAST(EXTRACT(MONTH FROM "date_invoice") AS INTEGER) AS month_invoice,
			CAST(EXTRACT(YEAR FROM "date_invoice") AS INTEGER) AS year_invoice,
			rcr.rating,
			
			(
				CASE WHEN rcr.rating IS NULL THEN( 
					( CASE WHEN (
						CASE WHEN rcr.rating IS NULL AND rc.id=13 THEN 1 ELSE CASE WHEN rcr.rating IS NULL THEN 0 END END
					) = 0 THEN (
						SELECT rating FROM res_currency_rate WHERE ai.currency_id=rc.id AND NAME < ai.date_invoice ORDER BY NAME DESC LIMIT 1
					) * ai.amount_untaxed ELSE (1*ai.amount_untaxed) END ) 
				) 
				ELSE (rcr.rating*amount_untaxed) END
			) AS total_rated
		FROM
			account_invoice AS ai
		JOIN res_currency AS rc ON ai.currency_id=rc.id 
		LEFT OUTER JOIN res_currency_rate AS rcr ON rcr.currency_id=rc.id AND rcr.name = ai.date_invoice 
		WHERE
			ai.date_invoice BETWEEN '{$this->start_date}' AND '{$this->end_date}'
			AND ai.type='out_invoice'
			AND ai.state not in ('cancel','draft')
			{$userIdsWhere}
			{$groupIdsWhere}
		) AS ai_rated
	GROUP BY
		ai_rated.year_invoice,
		ai_rated.month_invoice,
		group_name
	ORDER BY 
		ai_rated.year_invoice ASC,
		ai_rated.month_invoice ASC
	) as grouped_ai
GROUP BY
	grouped_ai.group_name
ORDER BY
	grouped_ai.group_name
SQL;
		// echo '<text>'.$sql.'</text>';
		$cmd = $conn->createCommand($sql);
		$res = $cmd->queryAll();
		return $res;
	}



	private function qInvoiceState(){
		$sql = <<<SQL
			SELECT
				inv_state_sum.partner_id,
				res_partner.name,
				SUM(CASE WHEN inv_state_sum.status='Canceled' THEN inv_state_sum.subtotal ELSE 0 END) AS sub_cancel,
				SUM(CASE WHEN inv_state_sum.status='Paid' THEN inv_state_sum.subtotal ELSE 0 END) AS sub_paid,
				SUM(CASE WHEN inv_state_sum.status='Waiting For Payment' THEN inv_state_sum.subtotal ELSE 0 END) AS sub_waiting
				
			FROM(

				SELECT
					ai_rated.partner_id,
					ai_rated.status,
					SUM(ai_rated.total_rated) AS subtotal
				FROM
					(SELECT
						ai.*,
						(CASE WHEN state = 'cancel' THEN 'Canceled' ELSE (CASE WHEN state='paid' THEN 'Paid' ELSE 'Waiting For Payment' END) END) AS status,
						(
							CASE WHEN rcr.rating IS NULL THEN( 
								( CASE WHEN (
									CASE WHEN rcr.rating IS NULL AND rc.id=13 THEN 1 ELSE CASE WHEN rcr.rating IS NULL THEN 0 END END
								) = 0 THEN (
									SELECT rating FROM res_currency_rate WHERE ai.currency_id=rc.id AND NAME < ai.date_invoice ORDER BY NAME DESC LIMIT 1
								) * ai.amount_untaxed ELSE (1*ai.amount_untaxed) END ) 
							) 
							ELSE (rcr.rating*amount_untaxed) END
						) AS total_rated
					FROM "account_invoice" "ai"
					JOIN res_currency AS rc ON ai.currency_id=rc.id 
					LEFT OUTER JOIN res_currency_rate AS rcr ON rcr.currency_id=rc.id AND rcr.name = ai.date_invoice 
					WHERE 
						type in ('out_invoice')
						
					) AS ai_rated
				GROUP BY
					ai_rated.partner_id,ai_rated.status
				) as inv_state_sum
			JOIN res_partner ON inv_state_sum.partner_id=res_partner.id
			GROUP BY inv_state_sum.partner_id,res_partner.name
			ORDER BY res_partner.name ASC
SQL;
	}
}
