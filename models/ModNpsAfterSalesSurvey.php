<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblNpsAfterSalesSurvey".
 *
 * @property integer $ID
 * @property string $Name
 * @property integer $S1
 * @property string $S1Other
 * @property integer $S2
 * @property integer $S3
 * @property integer $S4
 * @property integer $S5
 * @property string $B1
 * @property integer $B1A
 * @property string $B1AOther
 * @property integer $B2
 * @property string $B3
 * @property string $B31
 * @property string $B32
 * @property string $B33
 * @property string $B34
 * @property string $B35
 * @property integer $B4
 * @property string $B51
 * @property integer $B52Type
 * @property string $B52Section1
 * @property string $B52Section2
 * @property string $B52Section3
 * @property string $B52Section4
 * @property string $B52Section5
 * @property integer $C1
 * @property integer $C2
 * @property integer $C3
 * @property string $C31
 * @property string $AddTime
 */
class ModNpsAfterSalesSurvey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblNpsAfterSalesSurvey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name', 'S1', 'S2', 'S3', 'S4', 'S5', 'B1', 'B1A', 'B2', 'B3', 'B31', 'B32', 'B33', 'B34', 'B35', 'B4', 'B51', 'B52Type', 'C1', 'C2', 'C3', 'C31', 'AddTime'], 'required'],
            [['S1', 'S2', 'S3', 'S4', 'S5', 'B1A', 'B2', 'B4', 'B52Type', 'C1', 'C2', 'C3'], 'integer'],
            [['S1Other', 'AddTime'], 'safe'],
            [['Name', 'B1', 'B1AOther', 'B3', 'B31', 'B32', 'B33', 'B34', 'B35', 'B51', 'B52Section1', 'B52Section2', 'B52Section3', 'B52Section4', 'B52Section5', 'C31'], 'string', 'max' => 255],
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
            'S3' => 'S3',
            'S4' => 'S4',
            'S5' => 'S5',
            'B1' => 'B1',
            'B1A' => 'B1 A',
            'B1AOther' => 'B1 Aother',
            'B2' => 'B2',
            'B3' => 'B3',
            'B31' => 'B31',
            'B32' => 'B32',
            'B33' => 'B33',
            'B34' => 'B34',
            'B35' => 'B35',
            'B4' => 'B4',
            'B51' => 'B51',
            'B52Type' => 'B52 Type',
            'B52Section1' => 'B52 Section1',
            'B52Section2' => 'B52 Section2',
            'B52Section3' => 'B52 Section3',
            'B52Section4' => 'B52 Section4',
            'B52Section5' => 'B52 Section5',
            'C1' => 'C1',
            'C2' => 'C2',
            'C3' => 'C3',
            'C31' => 'C31',
            'AddTime' => 'Add Time',
        ];
    }
}
