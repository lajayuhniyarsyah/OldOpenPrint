<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SaleOrder;

/**
 * SaleOrderSearch represents the model behind the search form about `app\models\SaleOrder`.
 */
class SaleOrderSearch extends SaleOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'shop_id', 'partner_id', 'fiscal_position', 'user_id', 'payment_term', 'company_id', 'pricelist_id', 'partner_invoice_id', 'project_id', 'partner_shipping_id', 'incoterm', 'carrier_id', 'week', 'attention'], 'integer'],
            [['create_date', 'write_date', 'origin', 'order_policy', 'client_order_ref', 'date_order', 'note', 'state', 'date_confirm', 'name', 'invoice_quantity', 'picking_policy', 'worktype', 'delivery_date', 'attention_moved0', 'internal_notes', 'due_date','sales_man'], 'safe'],
            [['amount_tax', 'amount_untaxed', 'amount_total'], 'number'],
            [['shipped', 'sow12', 'sow11', 'sowC', 'sowA', 'sow9', 'sow8', 'sow3', 'sow2', 'sow1', 'sow7', 'sow6', 'sow5', 'sow4', 'sowB', 'sow14', 'sow13', 'sow10', 'kondisi3', 'kondisi2', 'kondisi1'], 'boolean'],
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
        $query = SaleOrder::find();

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
            'write_uid' => $params['uid'],
            'shop_id' => $this->shop_id,
            'date_order' => $this->date_order,
            'partner_id' => $this->partner_id,
            'fiscal_position' => $this->fiscal_position,
            'user_id' => $this->user_id,
            'payment_term' => $this->payment_term,
            'company_id' => $this->company_id,
            'amount_tax' => $this->amount_tax,
            'pricelist_id' => $this->pricelist_id,
            'partner_invoice_id' => $this->partner_invoice_id,
            'amount_untaxed' => $this->amount_untaxed,
            'date_confirm' => $this->date_confirm,
            'amount_total' => $this->amount_total,
            'project_id' => $this->project_id,
            'partner_shipping_id' => $this->partner_shipping_id,
            'incoterm' => $this->incoterm,
            'shipped' => $this->shipped,
            'carrier_id' => $this->carrier_id,
            'delivery_date' => $this->delivery_date,
            'week' => $this->week,
            'kondisi3' => $this->kondisi3,
            'kondisi2' => $this->kondisi2,
            'kondisi1' => $this->kondisi1,
            'attention' => $this->attention,
            'due_date' => $this->due_date,
        ]);

        $query->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'order_policy', $this->order_policy])
            ->andFilterWhere(['like', 'client_order_ref', $this->client_order_ref])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'invoice_quantity', $this->invoice_quantity])
            ->andFilterWhere(['like', 'picking_policy', $this->picking_policy])
            ->andFilterWhere(['like', 'worktype', $this->worktype])
            ->andFilterWhere(['like', 'attention_moved0', $this->attention_moved0])
            ->andFilterWhere(['like', 'internal_notes', $this->internal_notes]);

        return $dataProvider;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchTrack($params,$uid,$onlyShowByCreateUid=true)
    {
        $query = SaleOrder::find();
        if($onlyShowByCreateUid){
            $query->andWhere('create_uid=:cuid')->addParams([':cuid'=>$uid]);
        }


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder'=>[
                    'name'=>SORT_ASC,
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            // 'create_uid' => $uid,
            'create_date' => $this->create_date,
            // 'write_date' => $this->write_date,
            // 'write_uid' => $uid,
            // 'shop_id' => $this->shop_id,
            'date_order' => $this->date_order,
            'partner_id' => $this->partner_id,
            'fiscal_position' => $this->fiscal_position,
            'user_id' => $this->user_id,
            'payment_term' => $this->payment_term,
            'company_id' => $this->company_id,
            'amount_tax' => $this->amount_tax,
            'pricelist_id' => $this->pricelist_id,
            'partner_invoice_id' => $this->partner_invoice_id,
            'amount_untaxed' => $this->amount_untaxed,
            'date_confirm' => $this->date_confirm,
            'amount_total' => $this->amount_total,
            'project_id' => $this->project_id,
            'partner_shipping_id' => $this->partner_shipping_id,
            'incoterm' => $this->incoterm,
            'shipped' => $this->shipped,
            'carrier_id' => $this->carrier_id,
            'delivery_date' => $this->delivery_date,
            'week' => $this->week,
            'kondisi3' => $this->kondisi3,
            'kondisi2' => $this->kondisi2,
            'kondisi1' => $this->kondisi1,
            'attention' => $this->attention,
            'due_date' => $this->due_date,
        ]);

        $query->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'order_policy', $this->order_policy])
            ->andFilterWhere(['like', 'client_order_ref', $this->client_order_ref])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'invoice_quantity', $this->invoice_quantity])
            ->andFilterWhere(['like', 'picking_policy', $this->picking_policy])
            ->andFilterWhere(['like', 'worktype', $this->worktype])
            ->andFilterWhere(['like', 'attention_moved0', $this->attention_moved0])
            ->andFilterWhere(['like', 'internal_notes', $this->internal_notes]);

        return $dataProvider;
    }
}
