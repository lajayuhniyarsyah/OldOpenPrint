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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'account_id', 'company_id', 'currency_id', 'partner_id', 'fiscal_position', 'user_id', 'partner_bank_id', 'payment_term', 'journal_id', 'period_id', 'move_id', 'commercial_partner_id', 'approver'], 'integer'],
            [['create_date', 'write_date', 'origin', 'date_due', 'reference', 'supplier_invoice_number', 'number', 'reference_type', 'state', 'type', 'internal_number', 'move_name', 'date_invoice', 'name', 'comment', 'kmk', 'faktur_pajak_no', 'kwitansi'], 'safe'],
            [['check_total', 'amount_tax', 'residual', 'amount_untaxed', 'amount_total', 'pajak', 'kurs'], 'number'],
            [['reconciled', 'sent'], 'boolean'],
        ];
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
    public function search($params)
    {
        $query = AccountInvoice::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
}
