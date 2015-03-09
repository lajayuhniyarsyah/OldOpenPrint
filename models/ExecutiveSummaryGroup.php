<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "executive_summary_group".
 *
 * @property integer $gid
 * @property string $group_name
 * @property integer $year_invoice
 * @property integer $user_id
 * @property double $amount_target
 * @property double $ytd_target
 * @property string $name
 * @property string $ytd_sales_achievement
 * @property string $achievement
 */
class ExecutiveSummaryGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'executive_summary_group';
    }

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
    public function attributeLabels()
    {
        return [
            'gid' => 'Gid',
            'group_name' => 'Group Name',
            'year_invoice' => 'Year Invoice',
            'user_id' => 'User ID',
            'amount_target' => 'Amount Target',
            'ytd_target' => 'Ytd Target',
            'name' => 'Name',
            'ytd_sales_achievement' => 'Ytd Sales Achievement',
            'achievement' => 'Achievement',
        ];
    }
}
