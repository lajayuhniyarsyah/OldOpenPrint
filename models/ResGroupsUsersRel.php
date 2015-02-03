<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "res_groups_users_rel".
 *
 * @property integer $uid
 * @property integer $gid
 *
 * @property ResGroups $g
 * @property ResUsers $u
 */
class ResGroupsUsersRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'res_groups_users_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'gid'], 'required'],
            [['uid', 'gid'], 'integer'],
            [['uid', 'gid'], 'unique', 'targetAttribute' => ['uid', 'gid'], 'message' => 'The combination of Uid and Gid has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'gid' => 'Gid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getG()
    {
        return $this->hasOne(ResGroups::className(), ['id' => 'gid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(ResUsers::className(), ['id' => 'uid']);
    }
}
