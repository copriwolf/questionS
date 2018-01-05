<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblMysteriousQuestionAnswerMap".
 *
 * @property integer $ID
 * @property integer $QuestionID
 * @property integer $AnswerID
 */
class ModMysteriousQuestionAnswerMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblMysteriousQuestionAnswerMap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['QuestionID', 'AnswerID'], 'required'],
            [['QuestionID', 'AnswerID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'QuestionID' => 'Question ID',
            'AnswerID' => 'Answer ID',
        ];
    }
}
