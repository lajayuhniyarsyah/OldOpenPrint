<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "res_groups".
 *
 * @property integer $id
 * @property string $name
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $comment
 * @property integer $category_id
 * @property boolean $share
 * @property boolean $is_portal
 *
 * @property ResGroupsUsersRel[] $resGroupsUsersRels
 * @property ProcessTransitionGroupRel[] $processTransitionGroupRels
 * @property WkfTransition[] $wkfTransitions
 * @property IrModelAccess[] $irModelAccesses
 * @property IrUiViewGroupRel[] $irUiViewGroupRels
 * @property ResGroupsWizardRel[] $resGroupsWizardRels
 * @property ResGroupsActionRel[] $resGroupsActionRels
 * @property IrUiMenuGroupRel[] $irUiMenuGroupRels
 * @property ResGroupsReportRel[] $resGroupsReportRels
 * @property IrActWindowGroupRel[] $irActWindowGroupRels
 * @property IrModelFieldsGroupRel[] $irModelFieldsGroupRels
 * @property RuleGroupRel[] $ruleGroupRels
 * @property ResGroupsImpliedRel[] $resGroupsImpliedRels
 * @property MailGroup[] $mailGroups
 * @property MailGroupResGroupRel[] $mailGroupResGroupRels
 * @property IrModuleCategory $category
 * @property ResUsers $writeU
 * @property ResUsers $createU
 * @property AccountJournalGroupRel[] $accountJournalGroupRels
 * @property PortalWizard[] $portalWizards
 * @property ShareWizardResGroupRel[] $shareWizardResGroupRels
 */
class ResGroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_groups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_uid', 'write_uid', 'category_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['comment'], 'string'],
            [['share', 'is_portal'], 'boolean'],
            [['name'], 'string', 'max' => 64],
            [['category_id', 'name'], 'unique', 'targetAttribute' => ['category_id', 'name'], 'message' => 'The combination of Name and Category ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_uid' => 'Create Uid',
            'create_date' => 'Create Date',
            'write_date' => 'Write Date',
            'write_uid' => 'Write Uid',
            'comment' => 'Comment',
            'category_id' => 'Category ID',
            'share' => 'Share',
            'is_portal' => 'Is Portal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroupsUsersRels()
    {
        return $this->hasMany(ResGroupsUsersRel::className(), ['gid' => 'id']);
    }

    public function getUsers(){
        return $this->hasMany(ResUsers::className(),['id'=>'uid'])->via('resGroupsUsersRels');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessTransitionGroupRels()
    {
        return $this->hasMany(ProcessTransitionGroupRel::className(), ['rid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWkfTransitions()
    {
        return $this->hasMany(WkfTransition::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModelAccesses()
    {
        return $this->hasMany(IrModelAccess::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiViewGroupRels()
    {
        return $this->hasMany(IrUiViewGroupRel::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroupsWizardRels()
    {
        return $this->hasMany(ResGroupsWizardRel::className(), ['gid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroupsActionRels()
    {
        return $this->hasMany(ResGroupsActionRel::className(), ['gid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrUiMenuGroupRels()
    {
        return $this->hasMany(IrUiMenuGroupRel::className(), ['gid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroupsReportRels()
    {
        return $this->hasMany(ResGroupsReportRel::className(), ['gid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrActWindowGroupRels()
    {
        return $this->hasMany(IrActWindowGroupRel::className(), ['gid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrModelFieldsGroupRels()
    {
        return $this->hasMany(IrModelFieldsGroupRel::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleGroupRels()
    {
        return $this->hasMany(RuleGroupRel::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResGroupsImpliedRels()
    {
        return $this->hasMany(ResGroupsImpliedRel::className(), ['gid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailGroups()
    {
        return $this->hasMany(MailGroup::className(), ['group_public_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMailGroupResGroupRels()
    {
        return $this->hasMany(MailGroupResGroupRel::className(), ['groups_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(IrModuleCategory::className(), ['id' => 'category_id']);
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
    public function getAccountJournalGroupRels()
    {
        return $this->hasMany(AccountJournalGroupRel::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortalWizards()
    {
        return $this->hasMany(PortalWizard::className(), ['portal_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShareWizardResGroupRels()
    {
        return $this->hasMany(ShareWizardResGroupRel::className(), ['group_id' => 'id']);
    }
}
