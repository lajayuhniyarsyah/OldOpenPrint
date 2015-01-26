<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeliveryNote;

/**
 * DeliveryNoteSearch represents the model behind the search form about `app\models\DeliveryNote`.
 */
class DeliveryNoteSearch extends DeliveryNote
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'partner_id', 'partner_shipping_id', 'prepare_id', 'work_order_id', 'work_order_in'], 'integer'],
            [['create_date', 'write_date', 'colorcode', 'poc', 'name', 'note', 'state', 'tanggal', 'ekspedisi', 'jumlah_coli', 'terms'], 'safe'],
            [['special'], 'boolean'],
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
        $query = DeliveryNote::find();

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
            'partner_id' => $this->partner_id,
            'partner_shipping_id' => $this->partner_shipping_id,
            'tanggal' => $this->tanggal,
            'prepare_id' => $this->prepare_id,
            'special' => $this->special,
            'work_order_id' => $this->work_order_id,
            'work_order_in' => $this->work_order_in,
        ]);

        $query->andFilterWhere(['like', 'colorcode', $this->colorcode])
            ->andFilterWhere(['like', 'poc', $this->poc])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'ekspedisi', $this->ekspedisi])
            ->andFilterWhere(['like', 'jumlah_coli', $this->jumlah_coli])
            ->andFilterWhere(['like', 'terms', $this->terms]);

        return $dataProvider;
    }
}
