<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblNpsAnswer".
 *
 * @property integer $ID
 * @property integer $Sort
 * @property string $Content
 */
class ModNpsAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblNpsAnswer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Sort', 'Content'], 'required'],
            [['Sort'], 'integer'],
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
        ];
    }
}
