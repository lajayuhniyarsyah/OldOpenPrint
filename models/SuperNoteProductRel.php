<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "super_note_product_rel".
 *
 * @property integer $super_note_id
 * @property integer $product_id
 *
 * @property ProductProduct $product
 * @property SuperNotes $superNote
 */
class SuperNoteProductRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'super_note_product_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['super_note_id', 'product_id'], 'required'],
            [['super_note_id', 'product_id'], 'integer'],
            [['super_note_id', 'product_id'], 'unique', 'targetAttribute' => ['super_note_id', 'product_id'], 'message' => 'The combination of Super Note ID and Product ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'super_note_id' => 'Super Note ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(ProductProduct::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperNote()
    {
        return $this->hasOne(SuperNotes::className(), ['id' => 'super_note_id']);
    }
}
