<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblMysteriousAnswer".
 *
 * @property integer $ID
 * @property integer $Sort
 * @property string $Content
 * @property integer $HasText
 */
class ModMysteriousAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblMysteriousAnswer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Sort', 'Content', 'HasText'], 'required'],
            [['Sort', 'HasText'], 'integer'],
            [['Content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Sort' => 'Sort',
            'Content' => 'Content',
            'HasText' => 'Has Text',
        ];
    }
}
