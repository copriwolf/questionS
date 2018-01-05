<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblMysteriousTelephoneSurvey".
 *
 * @property integer $ID
 * @property string $Name
 * @property integer $A1
 * @property integer $A1A
 * @property integer $A1B
 * @property integer $A2
 * @property integer $A3
 * @property string $AddTime
 */
class ModMysteriousTelephoneSurvey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblMysteriousTelephoneSurvey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'A1', 'A1A', 'A1B', 'A2', 'A3', 'AddTime'], 'required'],
            [['A1', 'A1A', 'A1B', 'A2', 'A3'], 'integer'],
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
            'A1' => 'A1',
            'A1A' => 'A1 A',
            'A1B' => 'A1 B',
            'A2' => 'A2',
            'A3' => 'A3',
            'AddTime' => 'Add Time',
        ];
    }
}
