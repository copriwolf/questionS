<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblNpsSalesSurvey".
 *
 * @property integer $ID
 * @property string $Name
 * @property integer $S1
 * @property string $S1Other
 * @property integer $S2
 * @property string $S2Other
 * @property integer $S3
 * @property integer $S4
 * @property integer $S5
 * @property string $A1
 * @property integer $A2
 * @property integer $A3
 * @property string $A31
 * @property string $A42A1
 * @property string $A42A2
 * @property string $A42A3
 * @property string $A42A4
 * @property string $A42A5
 * @property string $A42B1
 * @property string $A42B2
 * @property string $A42B3
 * @property string $A42B4
 * @property string $A42B5
 * @property integer $C1
 * @property integer $C2
 * @property integer $C3
 * @property string $C3Other
 * @property string $AddTime
 */
class ModNpsSalesSurvey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblNpsSalesSurvey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'S1', 'S2', 'S3', 'S4', 'S5', 'A1', 'A2', 'A3', 'A31', 'A42A1', 'A42A2', 'A42A3', 'A42A4', 'A42A5', 'A42B1', 'A42B2', 'A42B3', 'A42B4', 'A42B5', 'C1', 'C2', 'C3', 'AddTime'], 'required'],
            [['S1', 'S2', 'S3', 'S4', 'S5', 'A2', 'A3', 'C1', 'C2', 'C3'], 'integer'],
            [['AddTime'], 'safe'],
            [['Name', 'S1Other', 'S2Other', 'A1', 'A31', 'A42A1', 'A42A2', 'A42A3', 'A42A4', 'A42A5', 'A42B1', 'A42B2', 'A42B3', 'A42B4', 'A42B5', 'C3Other'], 'string', 'max' => 255],
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
            'S1' => 'S1',
            'S1Other' => 'S1 Other',
            'S2' => 'S2',
            'S2Other' => 'S2 Other',
            'S3' => 'S3',
            'S4' => 'S4',
            'S5' => 'S5',
            'A1' => 'A1',
            'A2' => 'A2',
            'A3' => 'A3',
            'A31' => 'A31',
            'A42A1' => 'A42 A1',
            'A42A2' => 'A42 A2',
            'A42A3' => 'A42 A3',
            'A42A4' => 'A42 A4',
            'A42A5' => 'A42 A5',
            'A42B1' => 'A42 B1',
            'A42B2' => 'A42 B2',
            'A42B3' => 'A42 B3',
            'A42B4' => 'A42 B4',
            'A42B5' => 'A42 B5',
            'C1' => 'C1',
            'C2' => 'C2',
            'C3' => 'C3',
            'C3Other' => 'C3 Other',
            'AddTime' => 'Add Time',
        ];
    }
}
