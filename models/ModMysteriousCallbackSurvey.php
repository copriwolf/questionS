<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblMysteriousCallbackSurvey".
 *
 * @property integer $ID
 * @property string $Name
 * @property integer $F1
 * @property integer $F2
 * @property integer $F3
 * @property integer $F4
 * @property string $AddTime
 */
class ModMysteriousCallbackSurvey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblMysteriousCallbackSurvey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'F1', 'F2', 'F3', 'F4', 'AddTime'], 'required'],
            [['F1', 'F2', 'F3', 'F4'], 'integer'],
            [['AddTime'], 'safe'],
            [['Name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'F1' => 'F1',
            'F2' => 'F2',
            'F3' => 'F3',
            'F4' => 'F4',
            'AddTime' => 'Add Time',
        ];
    }
}
