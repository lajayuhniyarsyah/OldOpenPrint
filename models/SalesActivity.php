<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales_activity".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $begin
 * @property integer $user_id
 * @property string $end
 * @property string $name
 * @property string $state
 *
 * @property BeforePlanSelasa[] $beforePlanSelasas
 * @property AfterPlanSenin[] $afterPlanSenins
 * @property BeforePlanSenin[] $beforePlanSenins
 * @property AfterActualSenin[] $afterActualSenins
 * @property BeforeActualSenin[] $beforeActualSenins
 * @property BeforePlanKamis[] $beforePlanKamis
 * @property AfterPlanKamis[] $afterPlanKamis
 * @property AfterActualSelasa[] $afterActualSelasas
 * @property BeforePlanRabu[] $beforePlanRabus
 * @property AfterPlanRabu[] $afterPlanRabus
 * @property AfterActualRabu[] $afterActualRabus
 * @property BeforeActualRabu[] $beforeActualRabus
 * @property AfterPlanJumat[] $afterPlanJumats
 * @property BeforePlanJumat[] $beforePlanJumats
 * @property AfterActualJumat[] $afterActualJumats
 * @property BeforeActualJumat[] $beforeActualJumats
 * @property AfterActualKamis[] $afterActualKamis
 * @property ResUsers $user
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property AfterPlanSelasa[] $afterPlanSelasas
 * @property BeforeActualKamis[] $beforeActualKamis
 * @property BeforeActualSelasa[] $beforeActualSelasas
 * @property WizardActivity[] $wizardActivities
 * @property BeforePlanAhad[] $beforePlanAhads
 * @property AfterActualSabtu[] $afterActualSabtus
 * @property BeforeActualSabtu[] $beforeActualSabtus
 * @property AfterPlanAhad[] $afterPlanAhads
 * @property LogActivity[] $logActivities
 * @property BeforePlanSabtu[] $beforePlanSabtus
 * @property AfterPlanSabtu[] $afterPlanSabtus
 * @property BeforeActualAhad[] $beforeActualAhads
 * @property AfterActualAhad[] $afterActualAhads
 */
class SalesActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'user_id'], 'integer'],
            [['create_date', 'write_date', 'begin', 'end'], 'safe'],
            [['name'], 'required'],
            [['state'], 'string'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'begin' => 'Begin',
            'user_id' => 'User ID',
            'end' => 'End',
            'name' => 'Name',
            'state' => 'State',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSelasas()
    {
        return $this->hasMany(BeforePlanSelasa::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSenins()
    {
        return $this->hasMany(AfterPlanSenin::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSenins()
    {
        return $this->hasMany(BeforePlanSenin::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSenins()
    {
        return $this->hasMany(AfterActualSenin::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSenins()
    {
        return $this->hasMany(BeforeActualSenin::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanKamis()
    {
        return $this->hasMany(BeforePlanKamis::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanKamis()
    {
        return $this->hasMany(AfterPlanKamis::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSelasas()
    {
        return $this->hasMany(AfterActualSelasa::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanRabus()
    {
        return $this->hasMany(BeforePlanRabu::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanRabus()
    {
        return $this->hasMany(AfterPlanRabu::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualRabus()
    {
        return $this->hasMany(AfterActualRabu::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualRabus()
    {
        return $this->hasMany(BeforeActualRabu::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanJumats()
    {
        return $this->hasMany(AfterPlanJumat::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanJumats()
    {
        return $this->hasMany(BeforePlanJumat::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualJumats()
    {
        return $this->hasMany(AfterActualJumat::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualJumats()
    {
        return $this->hasMany(BeforeActualJumat::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualKamis()
    {
        return $this->hasMany(AfterActualKamis::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWriteU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'write_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreateU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'create_uid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSelasas()
    {
        return $this->hasMany(AfterPlanSelasa::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualKamis()
    {
        return $this->hasMany(BeforeActualKamis::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSelasas()
    {
        return $this->hasMany(BeforeActualSelasa::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWizardActivities()
    {
        return $this->hasMany(WizardActivity::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanAhads()
    {
        return $this->hasMany(BeforePlanAhad::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualSabtus()
    {
        return $this->hasMany(AfterActualSabtu::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualSabtus()
    {
        return $this->hasMany(BeforeActualSabtu::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanAhads()
    {
        return $this->hasMany(AfterPlanAhad::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogActivities()
    {
        return $this->hasMany(LogActivity::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforePlanSabtus()
    {
        return $this->hasMany(BeforePlanSabtu::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterPlanSabtus()
    {
        return $this->hasMany(AfterPlanSabtu::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeforeActualAhads()
    {
        return $this->hasMany(BeforeActualAhad::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAfterActualAhads()
    {
        return $this->hasMany(AfterActualAhad::className(), ['activity_id' => 'id']);
    }
}
