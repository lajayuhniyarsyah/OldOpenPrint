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
	public $start_date,$end_date,$sales_ids;
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'create_uid', 'write_uid', 'account_id', 'company_id', 'currency_id', 'partner_id', 'fiscal_position', 'user_id', 'partner_bank_id', 'payment_term', 'journal_id', 'period_id', 'move_id', 'commercial_partner_id', 'approver'], 'integer'],
			[['create_date', 'write_date', 'origin', 'date_due', 'reference', 'supplier_invoice_number', 'number', 'reference_type', 'state', 'type', 'internal_number', 'move_name', 'date_invoice', 'name', 'comment', 'kmk', 'faktur_pajak_no', 'kwitansi','start_date','end_date'], 'safe'],
			[['check_total', 'amount_tax', 'residual', 'amount_untaxed', 'amount_total', 'pajak', 'kurs'], 'number'],
			[['reconciled', 'sent'], 'boolean'],
			[['sales_ids'],'checkSales']
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

	/**
	 * @inheritdoc
	 */
	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params,$type=null)
	{
		$query = AccountInvoice::find();

		if($type) $query->where('type=:type')->addParams([':type'=>$type]);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort'  => [
				'defaultOrder'=>[
					'create_date'=>SORT_DESC,
				]
			]
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
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
			'date_invoice' => $this->date_invoice,
			'period_id' => $this->period_id,
			'amount_untaxed' => $this->amount_untaxed,
			'move_id' => $this->move_id,
			'amount_total' => $this->amount_total,
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
	grouped_ai.user_id, 
	p.name as sales_name, 
	{$qSelectMonthly}
FROM (
	SELECT 
		
		ai_rated.year_invoice,
		ai_rated.month_invoice,
		ai_rated.user_id,
		SUM(ai_rated.total_rated) as summary
		
	FROM
		(SELECT
			ai.id,
			ai.user_id,
			ai.amount_total,
			ai.date_invoice,
			CAST(EXTRACT(MONTH FROM "date_invoice") AS INTEGER) AS month_invoice,
			CAST(EXTRACT(YEAR FROM "date_invoice") AS INTEGER) AS year_invoice,
			rcr.rating,
			
			(
				CASE WHEN rcr.rating IS NULL THEN( 
					( CASE WHEN (
						CASE WHEN rcr.rating IS NULL AND rc.id=13 THEN 1 ELSE CASE WHEN rcr.rating IS NULL THEN 0 END END
					) = 0 THEN (
						SELECT rating FROM res_currency_rate WHERE ai.currency_id=rc.id AND NAME < ai.date_invoice ORDER BY NAME DESC LIMIT 1
					) * ai.amount_total ELSE (1*ai.amount_total) END ) 
				) 
				ELSE (rcr.rating*amount_total) END
			) AS total_rated
		FROM
			account_invoice AS ai
		JOIN res_currency AS rc ON ai.currency_id=rc.id 
		LEFT OUTER JOIN res_currency_rate AS rcr ON rcr.currency_id=rc.id AND rcr.name = ai.date_invoice 
		WHERE
			ai.date_invoice BETWEEN '{$this->start_date}' AND '{$this->end_date}'
			AND ai.type='out_invoice'
			AND ai.state not in ('cancel')
			{$userIdsWhere}
		) AS ai_rated
	GROUP BY
		ai_rated.year_invoice,
		ai_rated.month_invoice,
		ai_rated.user_id
	ORDER BY 
		ai_rated.year_invoice ASC,
		ai_rated.month_invoice ASC
	) as grouped_ai
LEFT OUTER JOIN res_users AS rusr ON grouped_ai.user_id = rusr.id 
LEFT OUTER JOIN res_partner as p ON p.id = rusr.partner_id 
GROUP BY
	grouped_ai.user_id
	,p.name
ORDER BY
	p.name ASC
SQL;
		// var_dump($sql);
		$cmd = $conn->createCommand($sql);
		$res = $cmd->queryAll();
		return $res;
	}
}
