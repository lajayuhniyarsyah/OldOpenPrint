<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packing_list_line".
 *
 * @property integer $id
 * @property integer $create_uid
 * @property string $create_date
 * @property string $write_date
 * @property integer $write_uid
 * @property integer $note_id
 * @property string $name
 * @property string $weight
 * @property string $measurement
 * @property string $color
 * @property string $urgent
 *
 * @property CatatanLine[] $catatanLines
 * @property ResUsers $writeU
 * @property DeliveryNote $note
 * @property ResUsers $createU
 * @property ProductListLine[] $productListLines
 */
class PackingListLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packing_list_line';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_uid', 'write_uid', 'note_id'], 'integer'],
            [['create_date', 'write_date'], 'safe'],
            [['note_id'], 'required'],
            [['name', 'weight', 'measurement', 'color', 'urgent'], 'string', 'max' => 64]
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
            'note_id' => 'Delivery Note',
            'name' => 'Package',
            'weight' => 'Weight',
            'measurement' => 'Measurement',
            'color' => 'Color Code',
            'urgent' => 'Urgent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatatanLines()
    {
        return $this->hasMany(CatatanLine::className(), ['packing_id' => 'id']);
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
    public function getNote()
    {
        return $this->hasOne(DeliveryNote::className(), ['id' => 'note_id']);
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
    public function getProductListLines()
    {
        return $this->hasMany(ProductListLine::className(), ['packing_id' => 'id'])->orderBy('no, id ASC');
    }
}
