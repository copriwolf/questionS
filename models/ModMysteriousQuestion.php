<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblMysteriousQuestion".
 *
 * @property integer $ID
 * @property integer $SurveyType
 * @property integer $QuestionType
 * @property string $Num
 * @property string $Content
 */
class ModMysteriousQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblMysteriousQuestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SurveyType', 'QuestionType', 'Num', 'Content'], 'required'],
            [['SurveyType', 'QuestionType'], 'integer'],
            [['Num'], 'string', 'max' => 5],
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
            'SurveyType' => 'Survey Type',
            'QuestionType' => 'Question Type',
            'Num' => 'Num',
            'Content' => 'Content',
        ];
    }
}
