<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StockMove;

/**
 * StockMoveSearch represents the model behind the search form about `app\models\StockMove`.
 */
class StockMoveSearch extends StockMove
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'product_uom', 'prodlot_id', 'move_dest_id', 'product_uos', 'partner_id', 'product_id', 'price_currency_id', 'location_id', 'company_id', 'picking_id', 'location_dest_id', 'tracking_id', 'product_packaging', 'purchase_line_id', 'sale_line_id', 'production_id', 'weight_uom_id', 'no_moved0', 'no'], 'integer'],
            [['create_date', 'write_date', 'origin', 'date_expected', 'date', 'note', 'priority', 'state', 'no_moved1', 'name', 'desc'], 'safe'],
            [['product_uos_qty', 'price_unit', 'product_qty', 'weight', 'weight_net'], 'number'],
            [['auto_validate'], 'boolean'],
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
        $query = StockMove::find();

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
            'product_uos_qty' => $this->product_uos_qty,
            'date_expected' => $this->date_expected,
            'product_uom' => $this->product_uom,
            'price_unit' => $this->price_unit,
            'date' => $this->date,
            'prodlot_id' => $this->prodlot_id,
            'move_dest_id' => $this->move_dest_id,
            'product_qty' => $this->product_qty,
            'product_uos' => $this->product_uos,
            'partner_id' => $this->partner_id,
            'product_id' => $this->product_id,
            'auto_validate' => $this->auto_validate,
            'price_currency_id' => $this->price_currency_id,
            'location_id' => $this->location_id,
            'company_id' => $this->company_id,
            'picking_id' => $this->picking_id,
            'location_dest_id' => $this->location_dest_id,
            'tracking_id' => $this->tracking_id,
            'product_packaging' => $this->product_packaging,
            'purchase_line_id' => $this->purchase_line_id,
            'sale_line_id' => $this->sale_line_id,
            'production_id' => $this->production_id,
            'weight' => $this->weight,
            'weight_net' => $this->weight_net,
            'weight_uom_id' => $this->weight_uom_id,
            'no_moved0' => $this->no_moved0,
            'no' => $this->no,
        ]);

        $query->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'no_moved1', $this->no_moved1])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }

    public function searchChild($parent)
    {
        $query = StockMove::find();
        $params['StockMoveSearch']['move_dest_id']=$parent;
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
            'product_uos_qty' => $this->product_uos_qty,
            'date_expected' => $this->date_expected,
            'product_uom' => $this->product_uom,
            'price_unit' => $this->price_unit,
            'date' => $this->date,
            'prodlot_id' => $this->prodlot_id,
            'move_dest_id' => $this->move_dest_id,
            'product_qty' => $this->product_qty,
            'product_uos' => $this->product_uos,
            'partner_id' => $this->partner_id,
            'product_id' => $this->product_id,
            'auto_validate' => $this->auto_validate,
            'price_currency_id' => $this->price_currency_id,
            'location_id' => $this->location_id,
            'company_id' => $this->company_id,
            'picking_id' => $this->picking_id,
            'location_dest_id' => $this->location_dest_id,
            'tracking_id' => $this->tracking_id,
            'product_packaging' => $this->product_packaging,
            'purchase_line_id' => $this->purchase_line_id,
            'sale_line_id' => $this->sale_line_id,
            'production_id' => $this->production_id,
            'weight' => $this->weight,
            'weight_net' => $this->weight_net,
            'weight_uom_id' => $this->weight_uom_id,
            'no_moved0' => $this->no_moved0,
            'no' => $this->no,
        ]);

        $query->andFilterWhere(['like', 'origin', $this->origin])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'priority', $this->priority])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'no_moved1', $this->no_moved1])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }

}
