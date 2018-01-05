<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblNpsQuestionAnswerMap".
 *
 * @property integer $ID
 * @property integer $QuestionID
 * @property integer $AnswerID
 * @property integer $NextQuestionID
 */
class ModNpsQuestionAnswerMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblNpsQuestionAnswerMap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['QuestionID', 'AnswerID', 'NextQuestionID'], 'required'],
            [['QuestionID', 'AnswerID', 'NextQuestionID'], 'integer'],
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
            'NextQuestionID' => 'Next Question ID',
        ];
    }
}
