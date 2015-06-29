<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductProduct;

/**
 * ProductProductSearch represents the model behind the search form about `app\models\ProductProduct`.
 */
class ProductProductSearch extends ProductProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'color', 'product_tmpl_id'], 'integer'],
            [['create_date', 'write_date', 'ean13', 'image', 'default_code', 'name_template', 'variants', 'image_medium', 'image_small', 'valuation', 'partner_code', 'expired_date', 'batch_code', 'partner_desc'], 'safe'],
            [['price_extra', 'price_margin'], 'number'],
            [['active', 'track_outgoing', 'track_incoming', 'track_production', 'not_stock', 'is_rent_item', 'hr_expense_ok'], 'boolean'],
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
        $query = ProductProduct::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'create_uid' => $this->create_uid,
            'create_date' => $this->create_date,
            'write_date' => $this->write_date,
            'write_uid' => $this->write_uid,
            'color' => $this->color,
            'price_extra' => $this->price_extra,
            'active' => $this->active,
            'product_tmpl_id' => $this->product_tmpl_id,
            'price_margin' => $this->price_margin,
            'track_outgoing' => $this->track_outgoing,
            'track_incoming' => $this->track_incoming,
            'track_production' => $this->track_production,
            'expired_date' => $this->expired_date,
            'not_stock' => $this->not_stock,
            'is_rent_item' => $this->is_rent_item,
            'hr_expense_ok' => $this->hr_expense_ok,
        ]);

        $query->andFilterWhere(['like', 'ean13', $this->ean13])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'default_code', $this->default_code])
            ->andFilterWhere(['like', 'name_template', $this->name_template])
            ->andFilterWhere(['like', 'variants', $this->variants])
            ->andFilterWhere(['like', 'image_medium', $this->image_medium])
            ->andFilterWhere(['like', 'image_small', $this->image_small])
            ->andFilterWhere(['like', 'valuation', $this->valuation])
            ->andFilterWhere(['like', 'partner_code', $this->partner_code])
            ->andFilterWhere(['like', 'batch_code', $this->batch_code])
            ->andFilterWhere(['like', 'partner_desc', $this->partner_desc]);

        return $dataProvider;
    }
}
