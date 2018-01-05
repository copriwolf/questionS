<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblMysteriousInvestigateSurvey".
 *
 * @property integer $ID
 * @property integer $B1a
 * @property string $B1aText
 * @property integer $B1b
 * @property integer $B1c
 * @property integer $B1d
 * @property integer $B2
 * @property integer $B3a
 * @property integer $B3b
 * @property integer $B4
 * @property string $B4Text
 * @property integer $B5
 * @property integer $B6
 * @property integer $B7
 * @property integer $B8
 * @property integer $B9a
 * @property string $B9aText
 * @property integer $B9b
 * @property string $B9bText
 * @property integer $B10
 * @property string $B10Text
 * @property integer $B0
 * @property string $B0Text
 * @property integer $C1a
 * @property integer $C1b
 * @property integer $C1c
 * @property integer $C1d
 * @property integer $C1e
 * @property integer $C1f
 * @property integer $C2
 * @property integer $C3
 * @property integer $C4a
 * @property integer $C4b
 * @property integer $C5
 * @property integer $C6
 * @property integer $C7
 * @property string $C7Text
 * @property integer $C7a
 * @property string $C7aText
 * @property integer $C8a
 * @property integer $C8b
 * @property integer $C8c
 * @property integer $C8d
 * @property integer $C8e
 * @property integer $C8f
 * @property string $C8fText
 * @property integer $C9
 * @property string $C9Text
 * @property integer $C10
 * @property string $C10Text
 * @property integer $C11
 * @property integer $C12
 * @property integer $C13
 * @property integer $C14a
 * @property string $C14aText
 * @property integer $C14b
 * @property string $C14bText
 * @property integer $C14c
 * @property string $C14cText
 * @property integer $C15
 * @property string $C15Text
 * @property integer $C0
 * @property string $C0Text
 * @property integer $D1
 * @property integer $D1a
 * @property integer $D2a
 * @property string $D2aText
 * @property integer $D2b
 * @property integer $D2ba
 * @property string $D2baText
 * @property integer $D2c
 * @property integer $D2d
 * @property integer $D2e
 * @property integer $D2f
 * @property integer $D3
 * @property integer $D4a
 * @property string $D4aText
 * @property integer $D4b
 * @property string $D4bText
 * @property integer $D5
 * @property string $D5Text
 * @property integer $D6
 * @property string $D6Text
 * @property integer $D0a
 * @property string $D0aText
 * @property integer $D0b
 * @property string $D0bText
 * @property integer $E1
 * @property integer $E2
 * @property integer $E3
 * @property integer $E4
 * @property string $E4Text
 * @property integer $E5
 * @property integer $E6a
 * @property string $E6aText
 * @property integer $E6b
 * @property string $E6bText
 * @property integer $E6c
 * @property integer $E6d
 * @property string $E6dText
 * @property integer $E6e
 * @property integer $E6f
 * @property string $E6fText
 * @property integer $E6g
 * @property integer $E7
 * @property string $E7Text
 * @property integer $E8
 * @property integer $E9
 * @property string $E9Text
 * @property integer $E10
 * @property string $E10a
 * @property string $E10aText
 * @property integer $E11
 * @property string $E11Text
 * @property integer $E0
 * @property string $E0Text
 * @property integer $EB1
 * @property integer $EB2
 * @property integer $EB3
 * @property integer $EB4
 * @property string $EB4Text
 * @property integer $EB5
 * @property integer $EB6a
 * @property string $EB6aText
 * @property integer $EB6b
 * @property string $EB6bText
 * @property integer $EB6c
 * @property integer $EB6d
 * @property string $EB6dText
 * @property integer $EB6e
 * @property integer $EB6f
 * @property string $EB6fText
 * @property integer $EB6g
 * @property integer $EB7
 * @property integer $EB8
 * @property integer $EB9
 * @property string $EB9Text
 * @property integer $EB10
 * @property integer $EB10a
 * @property string $EB10aText
 * @property integer $EB11
 * @property string $EB11Text
 * @property integer $EB0
 * @property string $EB0Text
 * @property integer $G1
 * @property string $G1Text
 * @property integer $G2
 * @property string $G2Text
 * @property integer $R1
 * @property string $R1Text
 * @property integer $R2
 * @property string $R2Text
 * @property integer $R3
 * @property string $R3Text
 * @property integer $R4
 * @property string $R4Text
 * @property integer $R5
 * @property string $R5Text
 * @property integer $R6
 * @property string $R6Text
 * @property integer $R7
 * @property integer $R8
 * @property integer $R9
 */
class ModMysteriousInvestigateSurvey extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblMysteriousInvestigateSurvey';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['B1a', 'B1aText', 'B1b', 'B1c', 'B1d', 'B2', 'B3a', 'B3b', 'B4', 'B4Text', 'B5', 'B6', 'B7', 'B8', 'B9a', 'B9aText', 'B9b', 'B9bText', 'B10', 'B10Text', 'B0', 'B0Text', 'C1a', 'C1b', 'C1c', 'C1d', 'C1e', 'C1f', 'C2', 'C3', 'C4a', 'C4b', 'C5', 'C6', 'C7', 'C7Text', 'C7a', 'C7aText', 'C8a', 'C8b', 'C8c', 'C8d', 'C8e', 'C8f', 'C8fText', 'C9', 'C9Text', 'C10', 'C10Text', 'C11', 'C12', 'C13', 'C14a', 'C14aText', 'C14b', 'C14bText', 'C14c', 'C14cText', 'C15', 'C15Text', 'C0', 'C0Text', 'D1', 'D1a', 'D2a', 'D2aText', 'D2b', 'D2ba', 'D2baText', 'D2c', 'D2d', 'D2e', 'D2f', 'D3', 'D4a', 'D4aText', 'D4b', 'D4bText', 'D5', 'D5Text', 'D6', 'D6Text', 'D0a', 'D0aText', 'D0b', 'D0bText', 'E1', 'E2', 'E3', 'E4', 'E4Text', 'E5', 'E6a', 'E6aText', 'E6b', 'E6bText', 'E6c', 'E6d', 'E6dText', 'E6e', 'E6f', 'E6fText', 'E6g', 'E7', 'E7Text', 'E8', 'E9', 'E9Text', 'E10', 'E10a', 'E10aText', 'E11', 'E11Text', 'E0', 'E0Text', 'EB1', 'EB2', 'EB3', 'EB4', 'EB4Text', 'EB5', 'EB6a', 'EB6aText', 'EB6b', 'EB6bText', 'EB6c', 'EB6d', 'EB6dText', 'EB6e', 'EB6f', 'EB6fText', 'EB6g', 'EB7', 'EB8', 'EB9', 'EB9Text', 'EB10', 'EB10a', 'EB10aText', 'EB11', 'EB11Text', 'EB0', 'EB0Text', 'G1', 'G1Text', 'G2', 'G2Text', 'R1', 'R1Text', 'R2', 'R2Text', 'R3', 'R3Text', 'R4', 'R4Text', 'R5', 'R5Text', 'R6', 'R6Text', 'R7', 'R8', 'R9'], 'required'],
            [['B1a', 'B1b', 'B1c', 'B1d', 'B2', 'B3a', 'B3b', 'B4', 'B5', 'B6', 'B7', 'B8', 'B9a', 'B9b', 'B10', 'B0', 'C1a', 'C1b', 'C1c', 'C1d', 'C1e', 'C1f', 'C2', 'C3', 'C4a', 'C4b', 'C5', 'C6', 'C7', 'C7a', 'C8a', 'C8b', 'C8c', 'C8d', 'C8e', 'C8f', 'C9', 'C10', 'C11', 'C12', 'C13', 'C14a', 'C14b', 'C14c', 'C15', 'C0', 'D1', 'D1a', 'D2a', 'D2b', 'D2ba', 'D2c', 'D2d', 'D2e', 'D2f', 'D3', 'D4a', 'D4b', 'D5', 'D6', 'D0a', 'D0b', 'E1', 'E2', 'E3', 'E4', 'E5', 'E6a', 'E6b', 'E6c', 'E6d', 'E6e', 'E6f', 'E6g', 'E7', 'E8', 'E9', 'E10', 'E11', 'E0', 'EB1', 'EB2', 'EB3', 'EB4', 'EB5', 'EB6a', 'EB6b', 'EB6c', 'EB6d', 'EB6e', 'EB6f', 'EB6g', 'EB7', 'EB8', 'EB9', 'EB10', 'EB10a', 'EB11', 'EB0', 'G1', 'G2', 'R1', 'R2', 'R3', 'R4', 'R5', 'R6', 'R7', 'R8', 'R9'], 'integer'],
            [['B1aText', 'B4Text', 'B9aText', 'B9bText', 'B10Text', 'B0Text', 'C7Text', 'C7aText', 'C8fText', 'C9Text', 'C10Text', 'C14aText', 'C14bText', 'C14cText', 'C15Text', 'C0Text', 'D2aText', 'D2baText', 'D4aText', 'D4bText', 'D5Text', 'D6Text', 'D0aText', 'D0bText', 'E4Text', 'E6aText', 'E6bText', 'E6dText', 'E6fText', 'E7Text', 'E9Text', 'E10a', 'E10aText', 'E11Text', 'E0Text', 'EB4Text', 'EB6aText', 'EB6bText', 'EB6dText', 'EB6fText', 'EB9Text', 'EB10aText', 'EB11Text', 'EB0Text', 'G1Text', 'G2Text', 'R1Text', 'R2Text', 'R3Text', 'R4Text', 'R5Text', 'R6Text'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'B1a' => 'B1a',
            'B1aText' => 'B1a Text',
            'B1b' => 'B1b',
            'B1c' => 'B1c',
            'B1d' => 'B1d',
            'B2' => 'B2',
            'B3a' => 'B3a',
            'B3b' => 'B3b',
            'B4' => 'B4',
            'B4Text' => 'B4 Text',
            'B5' => 'B5',
            'B6' => 'B6',
            'B7' => 'B7',
            'B8' => 'B8',
            'B9a' => 'B9a',
            'B9aText' => 'B9a Text',
            'B9b' => 'B9b',
            'B9bText' => 'B9b Text',
            'B10' => 'B10',
            'B10Text' => 'B10 Text',
            'B0' => 'B0',
            'B0Text' => 'B0 Text',
            'C1a' => 'C1a',
            'C1b' => 'C1b',
            'C1c' => 'C1c',
            'C1d' => 'C1d',
            'C1e' => 'C1e',
            'C1f' => 'C1f',
            'C2' => 'C2',
            'C3' => 'C3',
            'C4a' => 'C4a',
            'C4b' => 'C4b',
            'C5' => 'C5',
            'C6' => 'C6',
            'C7' => 'C7',
            'C7Text' => 'C7 Text',
            'C7a' => 'C7a',
            'C7aText' => 'C7a Text',
            'C8a' => 'C8a',
            'C8b' => 'C8b',
            'C8c' => 'C8c',
            'C8d' => 'C8d',
            'C8e' => 'C8e',
            'C8f' => 'C8f',
            'C8fText' => 'C8f Text',
            'C9' => 'C9',
            'C9Text' => 'C9 Text',
            'C10' => 'C10',
            'C10Text' => 'C10 Text',
            'C11' => 'C11',
            'C12' => 'C12',
            'C13' => 'C13',
            'C14a' => 'C14a',
            'C14aText' => 'C14a Text',
            'C14b' => 'C14b',
            'C14bText' => 'C14b Text',
            'C14c' => 'C14c',
            'C14cText' => 'C14c Text',
            'C15' => 'C15',
            'C15Text' => 'C15 Text',
            'C0' => 'C0',
            'C0Text' => 'C0 Text',
            'D1' => 'D1',
            'D1a' => 'D1a',
            'D2a' => 'D2a',
            'D2aText' => 'D2a Text',
            'D2b' => 'D2b',
            'D2ba' => 'D2ba',
            'D2baText' => 'D2ba Text',
            'D2c' => 'D2c',
            'D2d' => 'D2d',
            'D2e' => 'D2e',
            'D2f' => 'D2f',
            'D3' => 'D3',
            'D4a' => 'D4a',
            'D4aText' => 'D4a Text',
            'D4b' => 'D4b',
            'D4bText' => 'D4b Text',
            'D5' => 'D5',
            'D5Text' => 'D5 Text',
            'D6' => 'D6',
            'D6Text' => 'D6 Text',
            'D0a' => 'D0a',
            'D0aText' => 'D0a Text',
            'D0b' => 'D0b',
            'D0bText' => 'D0b Text',
            'E1' => 'E1',
            'E2' => 'E2',
            'E3' => 'E3',
            'E4' => 'E4',
            'E4Text' => 'E4 Text',
            'E5' => 'E5',
            'E6a' => 'E6a',
            'E6aText' => 'E6a Text',
            'E6b' => 'E6b',
            'E6bText' => 'E6b Text',
            'E6c' => 'E6c',
            'E6d' => 'E6d',
            'E6dText' => 'E6d Text',
            'E6e' => 'E6e',
            'E6f' => 'E6f',
            'E6fText' => 'E6f Text',
            'E6g' => 'E6g',
            'E7' => 'E7',
            'E7Text' => 'E7 Text',
            'E8' => 'E8',
            'E9' => 'E9',
            'E9Text' => 'E9 Text',
            'E10' => 'E10',
            'E10a' => 'E10a',
            'E10aText' => 'E10a Text',
            'E11' => 'E11',
            'E11Text' => 'E11 Text',
            'E0' => 'E0',
            'E0Text' => 'E0 Text',
            'EB1' => 'Eb1',
            'EB2' => 'Eb2',
            'EB3' => 'Eb3',
            'EB4' => 'Eb4',
            'EB4Text' => 'Eb4 Text',
            'EB5' => 'Eb5',
            'EB6a' => 'Eb6a',
            'EB6aText' => 'Eb6a Text',
            'EB6b' => 'Eb6b',
            'EB6bText' => 'Eb6b Text',
            'EB6c' => 'Eb6c',
            'EB6d' => 'Eb6d',
            'EB6dText' => 'Eb6d Text',
            'EB6e' => 'Eb6e',
            'EB6f' => 'Eb6f',
            'EB6fText' => 'Eb6f Text',
            'EB6g' => 'Eb6g',
            'EB7' => 'Eb7',
            'EB8' => 'Eb8',
            'EB9' => 'Eb9',
            'EB9Text' => 'Eb9 Text',
            'EB10' => 'Eb10',
            'EB10a' => 'Eb10a',
            'EB10aText' => 'Eb10a Text',
            'EB11' => 'Eb11',
            'EB11Text' => 'Eb11 Text',
            'EB0' => 'Eb0',
            'EB0Text' => 'Eb0 Text',
            'G1' => 'G1',
            'G1Text' => 'G1 Text',
            'G2' => 'G2',
            'G2Text' => 'G2 Text',
            'R1' => 'R1',
            'R1Text' => 'R1 Text',
            'R2' => 'R2',
            'R2Text' => 'R2 Text',
            'R3' => 'R3',
            'R3Text' => 'R3 Text',
            'R4' => 'R4',
            'R4Text' => 'R4 Text',
            'R5' => 'R5',
            'R5Text' => 'R5 Text',
            'R6' => 'R6',
            'R6Text' => 'R6 Text',
            'R7' => 'R7',
            'R8' => 'R8',
            'R9' => 'R9',
        ];
    }
}
