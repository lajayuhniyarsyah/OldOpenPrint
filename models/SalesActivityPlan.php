<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales_activity_plan".
 *
 * @property integer $activity_id
 * @property boolean $not_planned_actual
 * @property double $year_p
 * @property double $week_no
 * @property integer $user_id
 * @property string $begin
 * @property string $end
 * @property string $the_date
 * @property integer $plan_id
 * @property string $name
 * @property integer $partner_id
 * @property string $location
 * @property integer $actual_partner_id
 * @property string $actual_location
 * @property string $actual_result
 * @property boolean $canceled_plan
 * @property integer $daylight
 * @property integer $dow
 */
class SalesActivityPlan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_activity_plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'user_id', 'plan_id', 'partner_id', 'actual_partner_id', 'daylight', 'dow'], 'integer'],
            [['not_planned_actual', 'canceled_plan'], 'boolean'],
            [['year_p', 'week_no'], 'number'],
            [['begin', 'end', 'the_date'], 'safe'],
            [['name', 'location', 'actual_result'], 'string'],
            [['actual_location'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activity_id' => 'Activity ID',
            'not_planned_actual' => 'Not Planned Actual',
            'year_p' => 'Year P',
            'week_no' => 'Week No',
            'user_id' => 'User ID',
            'begin' => 'Begin',
            'end' => 'End',
            'the_date' => 'The Date',
            'plan_id' => 'Plan ID',
            'name' => 'Name',
            'partner_id' => 'Partner ID',
            'location' => 'Location',
            'actual_partner_id' => 'Actual Partner ID',
            'actual_location' => 'Actual Location',
            'actual_result' => 'Actual Result',
            'canceled_plan' => 'Canceled Plan',
            'daylight' => 'Daylight',
            'dow' => 'Dow',
        ];
    }


    public function getPartner()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'partner_id']);
    }

    public function getUser()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'user_id']);
    }




    public function getActualPartner()
    {
        return $this->hasOne(ResPartner::className(), ['id' => 'actual_partner_id']);
    }
}
