<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StockPicking;

/**
 * StockPickingSearch represents the model behind the search form about `app\models\StockPicking`.
 */
class StockPickingSearch extends StockPicking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'partner_id', 'stock_journal_id', 'backorder_id', 'location_id', 'company_id', 'location_dest_id', 'purchase_id', 'sale_id', 'invoice_id', 'number_of_packages', 'carrier_id', 'weight_uom_id', 'note_id'], 'integer'],
            [['create_date', 'write_date', 'origin', 'date_done', 'min_date', 'date', 'name', 'move_type', 'invoice_state', 'note', 'state', 'max_date', 'type', 'carrier_tracking_ref', 'cust_doc_ref', 'lbm_no'], 'safe'],
            [['auto_picking', 'isset_set'], 'boolean'],
            [['weight', 'weight_net', 'volume'], 'number'],
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
        $query = StockPicking::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {

            return $dataProvider;
        }
        else
        {
            $query->andFilterWhere([
                'id' => $this->id,
                'create_uid' => $this->create_uid,
                'create_date' => $this->create_date,
                'write_date' => $this->write_date,
                'write_uid' => $this->write_uid,
                'date_done' => $this->date_done,
                'min_date' => $this->min_date,
                'date' => $this->date,
                'partner_id' => $this->partner_id,
                'stock_journal_id' => $this->stock_journal_id,
                'backorder_id' => $this->backorder_id,
                'location_id' => $this->location_id,
                'company_id' => $this->company_id,
                'location_dest_id' => $this->location_dest_id,
                'max_date' => $this->max_date,
                'auto_picking' => $this->auto_picking,
                'purchase_id' => $this->purchase_id,
                'sale_id' => $this->sale_id,
                'invoice_id' => $this->invoice_id,
                'number_of_packages' => $this->number_of_packages,
                'carrier_id' => $this->carrier_id,
                'weight' => $this->weight,
                'weight_uom_id' => $this->weight_uom_id,
                'weight_net' => $this->weight_net,
                'volume' => $this->volume,
                'note_id' => $this->note_id,
                'isset_set' => $this->isset_set,
            ]);

            $query->andFilterWhere(['like', 'origin', $this->origin])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'move_type', $this->move_type])
                ->andFilterWhere(['like', 'invoice_state', $this->invoice_state])
                ->andFilterWhere(['like', 'note', $this->note])
                ->andFilterWhere(['like', 'state', $this->state])
                ->andFilterWhere(['like', 'type', $this->type])
                ->andFilterWhere(['like', 'carrier_tracking_ref', $this->carrier_tracking_ref])
                ->andFilterWhere(['like', 'cust_doc_ref', $this->cust_doc_ref])
                ->andFilterWhere(['like', 'lbm_no', $this->lbm_no]);

            return $dataProvider;
        }
    }
}
