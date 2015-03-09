<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExecutiveSummaryGroup;
use yii\data\ArrayDataProvider;

/**
 * StockMoveSearch represents the model behind the search form about `app\models\StockMove`.
 */
class ExecutiveSummaryGroupSearch extends ExecutiveSummaryGroup
{
    public $default_order = 'name ASC';
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'year_invoice', 'user_id'], 'integer'],
            [['group_name'], 'string'],
            [['amount_target', 'ytd_target', 'ytd_sales_achievement', 'achievement'], 'number'],
            [['name'], 'string', 'max' => 128],
            [['gid','year_invoice','user_id','group_name','user_id'],'safe'],
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
    public function search()
    {
        $query = ExecutiveSummaryGroup::find()->asArray();

        $dataProvider = new ArrayDataProvider([
            'allModels'=>$query->all(),
            // 'query' => $query,
        ]);

        $query->andFilterWhere([
            'year_invoice'=>$this->year_invoice,
            'gid'=>$this->gid,
            'group_name'=>$this->group_name,
            'user_id'=>$this->user_id,
            'name'=>$this->name,
        ]);

        $query->orderBy($this->default_order);

        return $dataProvider;
    }

    public function getQuery(){
        $query = ExecutiveSummaryGroup::find()->asArray();
        if($this->validate()){
            $query->andFilterWhere([
                'year_invoice'=>$this->year_invoice,
                'gid'=>$this->gid,
                'group_name'=>$this->group_name,
                'user_id'=>$this->user_id,
                'name'=>$this->name,
            ]);
        }
        

        $query->orderBy($this->default_order);

        return $query;
    }

}
