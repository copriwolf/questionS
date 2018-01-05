<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblMysteriousInvestigateInfo".
 *
 * @property integer $ID
 * @property integer $SurveyID
 * @property string $OwnerIDNum
 * @property integer $OwnerAge
 * @property integer $OwnerSex
 * @property integer $OwnerConcerns
 * @property string $OwnerStorePhone
 * @property string $OwnerPhone
 * @property string $OwnerDrivenCar1
 * @property string $OwnerBeginDay
 * @property integer $OwnerBeginHour
 * @property integer $OwnerBeginMinus
 * @property string $OwnerEndDay
 * @property integer $OwnerEndHour
 * @property integer $OwnerEndMinus
 * @property string $OwnerName
 * @property string $OwnerReceptionistName
 * @property integer $OwnerReceptionistSex
 * @property integer $OwnerObjectiveCar
 * @property integer $OwnerObjectiveCarSituation
 * @property integer $OwnerWayIntoShop
 * @property string $OwnerDrivenCar2
 * @property string $EvaIDNum
 * @property integer $EvaAge
 * @property integer $EvaSex
 * @property integer $EvaConcerns
 * @property string $EvaStorePhone
 * @property string $EvaPhone
 * @property string $EvaDrivenCar1
 * @property string $EvaBeginDay
 * @property integer $EvaBeginHour
 * @property integer $EvaBeginMinus
 * @property string $EvaEndDay
 * @property integer $EvaEndHour
 * @property integer $EvaEndMinus
 * @property string $EvaName
 * @property string $EvaReceptionistName
 * @property integer $EvaReceptionistSex
 * @property integer $EvaObjectiveCar
 * @property integer $EvaObjectiveCarSituation
 * @property integer $EvaWayIntoShop
 * @property string $EvaDrivenCar2
 * @property string $AddTime
 */
class ModMysteriousInvestigateInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblMysteriousInvestigateInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SurveyID', 'OwnerIDNum', 'OwnerAge', 'OwnerSex', 'OwnerConcerns', 'OwnerStorePhone', 'OwnerPhone', 'OwnerDrivenCar1', 'OwnerBeginDay', 'OwnerBeginHour', 'OwnerBeginMinus', 'OwnerEndDay', 'OwnerEndHour', 'OwnerEndMinus', 'OwnerName', 'OwnerReceptionistName', 'OwnerReceptionistSex', 'OwnerObjectiveCar', 'OwnerObjectiveCarSituation', 'OwnerWayIntoShop', 'OwnerDrivenCar2', 'EvaIDNum', 'EvaAge', 'EvaSex', 'EvaConcerns', 'EvaStorePhone', 'EvaPhone', 'EvaDrivenCar1', 'EvaBeginDay', 'EvaBeginHour', 'EvaBeginMinus', 'EvaEndDay', 'EvaEndHour', 'EvaEndMinus', 'EvaName', 'EvaReceptionistName', 'EvaReceptionistSex', 'EvaObjectiveCar', 'EvaObjectiveCarSituation', 'EvaWayIntoShop', 'EvaDrivenCar2', 'AddTime'], 'required'],
            [['SurveyID', 'OwnerAge', 'OwnerSex', 'OwnerConcerns', 'OwnerBeginHour', 'OwnerBeginMinus', 'OwnerEndHour', 'OwnerEndMinus', 'OwnerReceptionistSex', 'OwnerObjectiveCar', 'OwnerObjectiveCarSituation', 'OwnerWayIntoShop', 'EvaAge', 'EvaSex', 'EvaConcerns', 'EvaBeginHour', 'EvaBeginMinus', 'EvaEndHour', 'EvaEndMinus', 'EvaReceptionistSex', 'EvaObjectiveCar', 'EvaObjectiveCarSituation', 'EvaWayIntoShop'], 'integer'],
            [['OwnerBeginDay', 'OwnerEndDay', 'EvaBeginDay', 'EvaEndDay', 'AddTime'], 'safe'],
            [['OwnerIDNum'], 'string', 'max' => 6],
            [['OwnerStorePhone', 'OwnerPhone', 'OwnerDrivenCar1', 'OwnerDrivenCar2', 'EvaIDNum', 'EvaStorePhone', 'EvaPhone', 'EvaDrivenCar1', 'EvaDrivenCar2'], 'string', 'max' => 255],
            [['OwnerName', 'OwnerReceptionistName', 'EvaName', 'EvaReceptionistName'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'SurveyID' => 'Survey ID',
            'OwnerIDNum' => 'Owner Idnum',
            'OwnerAge' => 'Owner Age',
            'OwnerSex' => 'Owner Sex',
            'OwnerConcerns' => 'Owner Concerns',
            'OwnerStorePhone' => 'Owner Store Phone',
            'OwnerPhone' => 'Owner Phone',
            'OwnerDrivenCar1' => 'Owner Driven Car1',
            'OwnerBeginDay' => 'Owner Begin Day',
            'OwnerBeginHour' => 'Owner Begin Hour',
            'OwnerBeginMinus' => 'Owner Begin Minus',
            'OwnerEndDay' => 'Owner End Day',
            'OwnerEndHour' => 'Owner End Hour',
            'OwnerEndMinus' => 'Owner End Minus',
            'OwnerName' => 'Owner Name',
            'OwnerReceptionistName' => 'Owner Receptionist Name',
            'OwnerReceptionistSex' => 'Owner Receptionist Sex',
            'OwnerObjectiveCar' => 'Owner Objective Car',
            'OwnerObjectiveCarSituation' => 'Owner Objective Car Situation',
            'OwnerWayIntoShop' => 'Owner Way Into Shop',
            'OwnerDrivenCar2' => 'Owner Driven Car2',
            'EvaIDNum' => 'Eva Idnum',
            'EvaAge' => 'Eva Age',
            'EvaSex' => 'Eva Sex',
            'EvaConcerns' => 'Eva Concerns',
            'EvaStorePhone' => 'Eva Store Phone',
            'EvaPhone' => 'Eva Phone',
            'EvaDrivenCar1' => 'Eva Driven Car1',
            'EvaBeginDay' => 'Eva Begin Day',
            'EvaBeginHour' => 'Eva Begin Hour',
            'EvaBeginMinus' => 'Eva Begin Minus',
            'EvaEndDay' => 'Eva End Day',
            'EvaEndHour' => 'Eva End Hour',
            'EvaEndMinus' => 'Eva End Minus',
            'EvaName' => 'Eva Name',
            'EvaReceptionistName' => 'Eva Receptionist Name',
            'EvaReceptionistSex' => 'Eva Receptionist Sex',
            'EvaObjectiveCar' => 'Eva Objective Car',
            'EvaObjectiveCarSituation' => 'Eva Objective Car Situation',
            'EvaWayIntoShop' => 'Eva Way Into Shop',
            'EvaDrivenCar2' => 'Eva Driven Car2',
            'AddTime' => 'Add Time',
        ];
    }
}
