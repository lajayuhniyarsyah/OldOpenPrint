<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MrpBom;

/**
 * MrpBomSearch represents the model behind the search form about `app\models\MrpBom`.
 */
class MrpBomSearch extends MrpBom
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'product_uom', 'product_uos', 'sequence', 'company_id', 'routing_id', 'product_id', 'bom_id'], 'integer'],
            [['create_date', 'write_date', 'date_stop', 'code', 'date_start', 'name', 'position', 'type'], 'safe'],
            [['product_uos_qty', 'product_qty', 'product_efficiency', 'product_rounding'], 'number'],
            [['active'], 'boolean'],
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
        $query = MrpBom::find();

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
            'date_stop' => $this->date_stop,
            'product_uom' => $this->product_uom,
            'product_uos_qty' => $this->product_uos_qty,
            'date_start' => $this->date_start,
            'product_qty' => $this->product_qty,
            'product_uos' => $this->product_uos,
            'product_efficiency' => $this->product_efficiency,
            'active' => $this->active,
            'product_rounding' => $this->product_rounding,
            'sequence' => $this->sequence,
            'company_id' => $this->company_id,
            'routing_id' => $this->routing_id,
            'product_id' => $this->product_id,
            'bom_id' => $this->bom_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }


    public function searchPhantom($params)
    {
        $query = MrpBom::find();
        $params['MrpBomSearch']['type']='phantom';
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
            'date_stop' => $this->date_stop,
            'product_uom' => $this->product_uom,
            'product_uos_qty' => $this->product_uos_qty,
            'date_start' => $this->date_start,
            'product_qty' => $this->product_qty,
            'product_uos' => $this->product_uos,
            'product_efficiency' => $this->product_efficiency,
            'active' => $this->active,
            'product_rounding' => $this->product_rounding,
            'sequence' => $this->sequence,
            'company_id' => $this->company_id,
            'routing_id' => $this->routing_id,
            'product_id' => $this->product_id,
            'bom_id' => $this->bom_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }

    public function searchBom($parent)
    {
        $query = MrpBom::find();
        $params['MrpBomSearch']['bom_id']=$parent;
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
            'date_stop' => $this->date_stop,
            'product_uom' => $this->product_uom,
            'product_uos_qty' => $this->product_uos_qty,
            'date_start' => $this->date_start,
            'product_qty' => $this->product_qty,
            'product_uos' => $this->product_uos,
            'product_efficiency' => $this->product_efficiency,
            'active' => $this->active,
            'product_rounding' => $this->product_rounding,
            'sequence' => $this->sequence,
            'company_id' => $this->company_id,
            'routing_id' => $this->routing_id,
            'product_id' => $this->product_id,
            'bom_id' => $this->bom_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
