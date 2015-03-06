<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalesActivity;

/**
 * SalesActivitySearch represents the model behind the search form about `app\models\SalesActivity`.
 */
class SalesActivitySearch extends SalesActivity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_uid', 'write_uid', 'user_id'], 'integer'],
            [['create_date', 'write_date', 'begin', 'end', 'name', 'state'], 'safe'],
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
        $query = SalesActivity::find();

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
            'begin' => $this->begin,
            'user_id' => $this->user_id,
            'end' => $this->end,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}
