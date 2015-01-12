<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "super_notes".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property string $template_note
 * @property string $name
 * @property string $desc
 * @property boolean $show_in_dn_line
 * @property boolean $show_in_do_line
 *
 * @property SuperNoteProductRel[] $superNoteProductRels
 * @property ResUsers $writeU
 * @property ResUsers $createU
 */
class SuperNotes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'super_notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['template_note', 'name', 'desc'], 'required'],
            [['template_note', 'desc'], 'string'],
            [['show_in_dn_line', 'show_in_do_line'], 'boolean'],
            [['name'], 'string', 'max' => 80]
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
            'template_note' => 'Note Template',
            'name' => 'Name',
            'desc' => 'Description',
            'show_in_dn_line' => 'Show In Delivery Note Line ?',
            'show_in_do_line' => 'Show In Delivery Order Line ?',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperNoteProductRels()
    {
        return $this->hasMany(SuperNoteProductRel::className(), ['super_note_id' => 'id']);
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
}
