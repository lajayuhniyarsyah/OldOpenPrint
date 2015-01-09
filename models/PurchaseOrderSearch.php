<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PurchaseOrder;

/**
 * PurchaseOrderSearch represents the model behind the search form about `app\models\PurchaseOrder`.
 */
class PurchaseOrderSearch extends PurchaseOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'journal_id', 'partner_id', 'dest_address_id', 'fiscal_position', 'location_id', 'company_id', 'pricelist_id', 'warehouse_id', 'payment_term_id', 'validator', 'port_moved0', 'print_line', 'attention'], 'integer'],
            [['create_date', 'write_date', 'origin', 'date_order', 'state', 'partner_ref', 'date_approve', 'name', 'notes', 'invoice_method', 'minimum_planned_date', 'subcont_type', 'yourref', 'note', 'other', 'jenis', 'type_permintaan', 'no_fpb', 'duedate', 'term_of_payment', 'scheduleddate', 'port', 'delivery', 'after_shipment', 'total_price', 'shipment_to'], 'safe'],
            [['amount_untaxed', 'amount_tax', 'amount_total'], 'number'],
            [['shipped', 'rm_sent'], 'boolean'],
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
        $query = PurchaseOrder::find();

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
            'journal_id' => $this->journal_id,
            'date_order' => $this->date_order,
            'partner_id' => $this->partner_id,
            'dest_address_id' => $this->dest_address_id,
            'fiscal_position' => $this->fiscal_position,
            'amount_untaxed' => $this->amount_untaxed,
            'location_id' => $this->location_id,
            'company_id' => $this->company_id,
            'amount_tax' => $this->amount_tax,
            'pricelist_id' => $this->pricelist_id,
            'warehouse_id' => $this->warehouse_id,
            'payment_term_id' => $this->payment_term_id,
            'date_approve' => $this->date_approve,
            'amount_total' => $this->amount_total,
            'shipped' => $this->shipped,
            'validator' => $this->validator,
            'minimum_planned_date' => $this->minimum_planned_date,
            'rm_sent' => $this->rm_sent,
            'port_moved0' => $this->port_moved0,
            'duedate' => $this->duedate,
            'scheduleddate' => $this->scheduleddate,
            'print_line' => $this->print_line,
            'attention' => $this->attention,
        ]);

        $query->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'partner_ref', $this->partner_ref])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'invoice_method', $this->invoice_method])
            ->andFilterWhere(['like', 'subcont_type', $this->subcont_type])
            ->andFilterWhere(['like', 'yourref', $this->yourref])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'other', $this->other])
            ->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'type_permintaan', $this->type_permintaan])
            ->andFilterWhere(['like', 'no_fpb', $this->no_fpb])
            ->andFilterWhere(['like', 'term_of_payment', $this->term_of_payment])
            ->andFilterWhere(['like', 'port', $this->port])
            ->andFilterWhere(['like', 'delivery', $this->delivery])
            ->andFilterWhere(['like', 'after_shipment', $this->after_shipment])
            ->andFilterWhere(['like', 'total_price', $this->total_price])
            ->andFilterWhere(['like', 'shipment_to', $this->shipment_to]);

        return $dataProvider;
    }
}
