<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ResPartner;

/**
 * ResPartnerSearch represents the model behind the search form about `app\models\ResPartner`.
 */
class ResPartnerSearch extends ResPartner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'create_uid', 'write_uid', 'color', 'user_id', 'title', 'country_id', 'parent_id', 'state_id'], 'integer'],
            [['name', 'lang', 'create_date', 'write_date', 'comment', 'ean13', 'image', 'street', 'city', 'zip', 'function', 'type', 'email', 'vat', 'website', 'fax', 'street2', 'phone', 'date', 'tz', 'image_medium', 'mobile', 'ref', 'image_small', 'birthdate', 'notification_email_send', 'signup_type', 'signup_expiration', 'signup_token', 'last_reconciliation_date', 'display_name', 'npwp', 'term_payment'], 'safe'],
            [['use_parent_address', 'active', 'supplier', 'employee', 'customer', 'is_company', 'opt_out'], 'boolean'],
            [['credit_limit', 'debit_limit'], 'number'],
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
        $query = ResPartner::find();

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
            'company_id' => $this->company_id,
            'create_uid' => $this->create_uid,
            'create_date' => $this->create_date,
            'write_date' => $this->write_date,
            'write_uid' => $this->write_uid,
            'color' => $this->color,
            'use_parent_address' => $this->use_parent_address,
            'active' => $this->active,
            'supplier' => $this->supplier,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'country_id' => $this->country_id,
            'parent_id' => $this->parent_id,
            'employee' => $this->employee,
            'credit_limit' => $this->credit_limit,
            'date' => $this->date,
            'customer' => $this->customer,
            'is_company' => $this->is_company,
            'state_id' => $this->state_id,
            'opt_out' => $this->opt_out,
            'signup_expiration' => $this->signup_expiration,
            'last_reconciliation_date' => $this->last_reconciliation_date,
            'debit_limit' => $this->debit_limit,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lang', $this->lang])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'ean13', $this->ean13])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'function', $this->function])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'vat', $this->vat])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'street2', $this->street2])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'tz', $this->tz])
            ->andFilterWhere(['like', 'image_medium', $this->image_medium])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'image_small', $this->image_small])
            ->andFilterWhere(['like', 'birthdate', $this->birthdate])
            ->andFilterWhere(['like', 'notification_email_send', $this->notification_email_send])
            ->andFilterWhere(['like', 'signup_type', $this->signup_type])
            ->andFilterWhere(['like', 'signup_token', $this->signup_token])
            ->andFilterWhere(['like', 'display_name', $this->display_name])
            ->andFilterWhere(['like', 'npwp', $this->npwp])
            ->andFilterWhere(['like', 'term_payment', $this->term_payment]);

        return $dataProvider;
    }
}
