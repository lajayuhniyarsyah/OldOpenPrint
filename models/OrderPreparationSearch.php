<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderPreparation;

/**
 * OrderPreparationSearch represents the model behind the search form about `app\models\OrderPreparation`.
 */
class OrderPreparationSearch extends OrderPreparation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'partner_shipping_id', 'sale_id', 'picking_id', 'partner_id'], 'integer'],
            [['create_date', 'write_date', 'name', 'duedate', 'note', 'state', 'tanggal', 'poc', 'terms'], 'safe'],
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
        $query = OrderPreparation::find();

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
            'partner_shipping_id' => $this->partner_shipping_id,
            'sale_id' => $this->sale_id,
            'duedate' => $this->duedate,
            'tanggal' => $this->tanggal,
            'picking_id' => $this->picking_id,
            'partner_id' => $this->partner_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'poc', $this->poc])
            ->andFilterWhere(['like', 'terms', $this->terms]);

        return $dataProvider;
    }
}
