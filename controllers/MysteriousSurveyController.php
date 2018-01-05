<?php

namespace app\controllers;

use Yii;
use app\models\ModMysteriousAnswer;
use app\models\ModMysteriousTelephoneSurvey;
use app\models\ModMysteriousCallbackSurvey;
use app\models\ModMysteriousInvestigateDict;
use app\models\ModMysteriousInvestigateInfo;
use app\models\ModMysteriousInvestigateSurvey;
use app\models\ModMysteriousQuestion;
use app\models\ModMysteriousQuestionAnswerMap;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\log\Logger;
use yii\filters\VerbFilter;

class MysteriousSurveyController extends Controller
{
    public $enableCsrfValidation = false;
    /**
        * @synopsis   获取神秘问卷内容
        * @param      string type 类型 1-电话咨询 2-回访问卷 3-现场调查问卷
        * @return     json 
     */
    public function actionGetSurveyData()
    {
        //$type = Yii::$app->request->post('type');
        $type = Yii::$app->request->get('type');
        // 1-电话咨询 2-回访问卷 3-现场调查问卷
        if( '1' === $type){
            $surveyType = 1;
        }elseif('2' === $type){
            $surveyType = 2;
        }elseif('3' === $type){
            $surveyType = 3;
        }else{
            self::jsonFormatOutput(201, '获取问卷失败-问卷类型获取失败');
        }

        // 获取数据
        $questionData = ModMysteriousQuestion::find()->where(['SurveyType'=>$surveyType])->asArray()->all();
        $answerData = ModMysteriousAnswer::find()->orderBy('Sort')->asArray()->all();
        $mapData = ModMysteriousQuestionAnswerMap::find()->asArray()->all();

        // 组装数据
        $data = [];
        $answerDataArr = [];
        foreach($questionData as $k => $v){
            $data[$v['ID']] = [
                // 题号
                'questionNum' => $v['Num'],
                // 题目类型 1-单选 2-记录 3-多选加记录
                'questionType' => $v['QuestionType'],
                // 题目内容
                'questionContent' => $v['Content'],
                'answer' => []
            ];
        }
        
        foreach($answerData as $k => $v){
            $answerDataArr[$v['ID']] = [
                'content' => $v['Content'],
                // 是否有附加文字 1-有 0-无
                'hasText' => $v['HasText']
            ];
        }

        foreach($mapData as $k => $v){
            if($data[$v['QuestionID']]){
                $data[$v['QuestionID']]['answer'][] = $answerDataArr[$v['AnswerID']];
            }
        }

        self::jsonFormatOutput(200, '获取问卷成功', $data);

    }

    /**
        * @synopsis     获取现场调查的基础信息 
        * @return       json       
     */
    public function actionGetMysteriousInvestigateDict()
    {
        $modelData = ModMysteriousInvestigateDict::find()->asArray()->all();
        $data = [];
        foreach($modelData as $k => $v){
            $data[$v['name']][$v['key']] = $v['content'];
        }
        self::jsonFormatOutput(200, '获取基础信息成功', $data);
    }

    /**
        * @synopsis     获取电话调查的结果 
        * @return       json       
     */
    public function actionGetMysteriousTelephoneInfo()
    {
        if (Yii::$app->user->isGuest || 'mysterious' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        //$id = Yii::$app->request->post('id', 0);
        $id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $model = new ModMysteriousTelephoneSurvey();
            $tmpData = $model->getDb()->createCommand('SELECT * FROM tblMysteriousTelephoneSurvey WHERE `ID` = :ID')
                ->bindValues([':ID'=>$id])
                ->queryOne();
            if(!$tmpData){
                self::jsonFormatOutput(202, '获取信息失败');
            }
            $userData = $tmpData;
        }else{
            self::jsonFormatOutput(201, 'id参数不全');
        }

        // 组装数据
        $questionData = ModMysteriousQuestion::find()->where(['SurveyType'=>1])->asArray()->all();
        $answerData = ModMysteriousAnswer::find()->orderBy('Sort')->asArray()->all();

        $questionArr = [];
        $questionArr['ID'] = '序号';
        $questionArr['Name'] = '姓名';
        $answerArr = [];
        foreach($questionData as $k =>$v){
            $questionArr[$v['Num']] = $v['Num'].':'.$v['Content'];
        }
        $questionArr['AddTime'] = '调查时间';
        foreach($answerData as $k => $v){
            $answerArr[$v['ID']] = $v['Content'];
        }

        foreach($userData as $kk => $v){
            if($answerArr[$v] && $kk !='ID' && $kk != 'Name' && $kk != 'AddTime'){
                $userData[$kk] = $answerArr[$v];
            }
        }

        $header = $questionArr;
        foreach($header as $k => $v){
            $data[$v] = $userData[$k];
        }
        self::jsonFormatOutput(200, '获取信息成功', $data);
    }

    /**
        * @synopsis     获取回访调查的结果 
        * @return       json       
     */
    public function actionGetMysteriousCallbackInfo()
    {
        if (Yii::$app->user->isGuest || 'mysterious' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        //$id = Yii::$app->request->post('id', 0);
        $id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $model = new ModMysteriousCallbackSurvey();
            $tmpData = $model->getDb()->createCommand('SELECT * FROM tblMysteriousCallbackSurvey WHERE `ID` = :ID')
                ->bindValues([':ID'=>$id])
                ->queryOne();
            if(!$tmpData){
                self::jsonFormatOutput(202, '获取信息失败');
            }
            $userData = $tmpData;
        }else{
            self::jsonFormatOutput(201, 'id参数不全');
        }

        // 组装数据
        $questionData = ModMysteriousQuestion::find()->where(['SurveyType'=>2])->asArray()->all();
        $answerData = ModMysteriousAnswer::find()->orderBy('Sort')->asArray()->all();

        $questionArr = [];
        $questionArr['ID'] = '序号';
        $questionArr['Name'] = '姓名';
        $answerArr = [];
        foreach($questionData as $k =>$v){
            $questionArr[$v['Num']] = $v['Num'].':'.$v['Content'];
        }
        $questionArr['AddTime'] = '调查时间';
        foreach($answerData as $k => $v){
            $answerArr[$v['ID']] = $v['Content'];
        }

        foreach($userData as $kk => $v){
            if($answerArr[$v] && $kk !='ID' && $kk != 'Name' && $kk != 'AddTime'){
                $userData[$kk] = $answerArr[$v];
            }
        }

        $header = $questionArr;
        foreach($header as $k => $v){
            $data[$v] = $userData[0][$k];
        } 
        self::jsonFormatOutput(200, '获取信息成功', $data);
    }
    
    /**
        * @synopsis      获取现场问卷的结果
        * @param         string id 用户的ID
        * @return        excel
     */
    public function actionGetMysteriousInvestigateInfo()
    {
        if (Yii::$app->user->isGuest || 'mysterious' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        //$id = Yii::$app->request->post('id', 0);
        $id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $sql = "
                SELECT * , i.`ID` AS ID
                FROM tblMysteriousInvestigateInfo i
                LEFT JOIN tblMysteriousInvestigateSurvey s ON i.`SurveyID` = s.`ID`
                WHERE i.`ID` = :ID";
            $model = new ModMysteriousInvestigateInfo();
            $tmpData = $model->getDb()->createCommand($sql, [':ID'=>$id])->queryOne();
            if(!$tmpData){
                self::jsonFormatOutput(202, '获取数据失败');
            }
            $userData[] = $tmpData;
        }else{
            self::jsonFormatOutput(201, 'id参数获取失败');
        }

        // 组装数据
        $questionData = ModMysteriousQuestion::find()->where(['SurveyType'=>3])->asArray()->all();
        $answerData = ModMysteriousAnswer::find()->orderBy('Sort')->asArray()->all();
        $dictData = ModMysteriousInvestigateDict::find()->asArray()->all();

        $header = [
            'ID' => '序号',
            'OwnerIDNum' => '车主身份证后六位',
            'OwnerAge' => '车主年龄',
            'OwnerSex' => '车主性别',
            'OwnerConcerns' => '车主购车关注点',
            'OwnerStorePhone' => '车主留店电话',
            'OwnerPhone' => '车主手机号码',
            'OwnerDrivenCar1' => '车主所开车型',
            'OwnerBeginDay' => '车主调查日期',
            'OwnerBeginHour' => '车主开始时间(小时)',
            'OwnerBeginMinus' => '车主开始时间(分钟)',
            'OwnerEndHour' => '车主结束时间(小时)',
            'OwnerEndMinus' => '车主结束时间(分钟)',
            'OwnerName' => '执行车主姓名',
            'OwnerReceptionistName' => '车主接待销售顾问姓名',
            'OwnerReceptionistSex' => '车主接待销售顾问性别',
            'OwnerObjectiveCar' => '车主目标购买车型',
            'OwnerObjectiveCarSituation' => '车主目标购买车型情况',
            'OwnerWayIntoShop' => '车主进店方式',
            'OwnerDrivenCar2' => '车主所开车型',
            'EvaIDNum' => '评估员-身份证',
            'EvaAge' => '评估员-年龄',
            'EvaSex' => '评估员-性别',
            'EvaConcerns' => '评估员-购车关注点',
            'EvaStorePhone' => '评估员-留店电话',
            'EvaPhone' => '评估员-手机号码',
            'EvaDrivenCar1' => '评估员-所开车型',
            'EvaBeginDay' => '评估员-调查日期',
            'EvaBeginHour' => '评估员开始时间(小时)',
            'EvaBeginMinus' => '评估员开始时间(分钟)',
            'EvaEndHour' => '评估员结束时间(小时)',
            'EvaEndMinus' => '评估员结束时间(分钟)',
            'EvaName' => '评估员-姓名',
            'EvaReceptionistName' => '评估员-接待销售顾问姓名',
            'EvaReceptionistSex' => '评估员-接待销售顾问性别',
            'EvaObjectiveCar' => '评估员-目标购买车型',
            'EvaObjectiveCarSituation' => '评估员-目标购买车型情况',
            'EvaWayIntoShop' => '评估员-进店方式',
            'EvaDrivenCar2' => '评估员-所开车型',
            'AddTime' => '表单创建时间'
        ];
        $questionArr = [];
        $answerArr = [];
        $dictArr = [];
        foreach($questionData as $k =>$v){
            $questionArr[$v['Num']] = $v['Num'].':'.$v['Content'];
        }
        foreach($answerData as $k => $v){
            $ansierArr[$v['ID']] = $v['Content'];
        }
        foreach($dictData as $k => $v){
            $dictArr[$v['name']][$v['key']] = $v['content'];
        }

        foreach($userData as $k => $singleUserData){
            foreach($singleUserData as $kk => $v){
                if(false !== strpos($kk,'Sex')){
                    $userData[$k][$kk] = $dictArr['Sex'][$v];
                    continue;
                }
                if(false !== strpos($kk,'ObjectiveCarSituation')){
                    $userData[$k][$kk] = $dictArr['ObjectiveCarSituation'][$v];
                    continue;
                }
                if(false !== strpos($kk,'ObjectiveCar')){
                    $userData[$k][$kk] = $dictArr['ObjectiveCar'][$v];
                    continue;
                }
                if(false !== strpos($kk,'WayIntoShop')){
                    $userData[$k][$kk] = $dictArr['WayIntoShop'][$v];
                    continue;
                }
                if(false !== strpos($kk,'Concerns')){
                    $userData[$k][$kk] = $dictArr['Concerns'][$v];
                    continue;
                }
                if($answerArr[$v] && $kk !='ID' && $kk != 'AddTime'){
                    $userData[$k][$kk] = $answerArr[$v];
                }
            }
        }

        $header = array_merge($header, $questionArr);
        $data = $userData[0];
        self::jsonFormatOutput(200, '获取成功', $data);
    }

    /**
        * @synopsis     电话问卷保存 
        * @param        见接口文档 
        * @return       json  
     */
    public function actionSaveMysteriousTelephoneSurvey()
    {
        $model = new ModMysteriousTelephoneSurvey();
        $post = Yii::$app->request->post();
        $post['AddTime'] = date('Y-m-d H:i:s');
        if ($model->load($post, 1) && $model->save()) {
            self::jsonFormatOutput(200, '电话问卷保存成功');
        }else{
            Yii::getLogger()->log(json_encode($model->getErrors()), Logger::LEVEL_INFO, 'MysteriousTelephoneSurvey');
            self::jsonFormatOutput(201, '电话问卷保存失败');
        }
    }


    /**
        * @synopsis     回访问卷保存 
        * @param        见接口文档 
        * @return       json  
     */
    public function actionSaveMysteriousCallbackSurvey()
    {
        $model = new ModMysteriousCallbackSurvey();
        $post = Yii::$app->request->post();
        $post['AddTime'] = date('Y-m-d H:i:s');
        if ($model->load($post, 1) && $model->save()) {
            self::jsonFormatOutput(200, '回访问卷保存成功');
        }else{
            Yii::getLogger()->log(json_encode($model->getErrors()), Logger::LEVEL_INFO, 'MysteriousCallbackSurvey');
            self::jsonFormatOutput(201, '回访问卷保存失败');
        }
    }

    /**
        * @synopsis     现场问卷保存 
        * @param        见接口文档 
        * @return       json  
     */
    public function actionSaveMysteriousInvestigateSurvey()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $post = Yii::$app->request->post();
            $surveyModel = new ModMysteriousInvestigateSurvey();
            if (!$surveyModel->load($post, 0, 'surveyData') || !$surveyModel->save()) {
                Yii::getLogger()->log(json_encode($surveyModel->getErrors()), Logger::LEVEL_INFO, 'MysteriousInvestigateSurvey');
                throw new Exception('现场问卷-问卷信息-保存失败', 201);
            }
            $infoModel = new ModMysteriousInvestigateInfo();
            $post['infoData']['AddTime'] = date('Y-m-d H:i:s');
            if (!$infoModel->load($post, 0, 'infoData') || !$infoModel->save()) {
                Yii::getLogger()->log(json_encode($infoModel->getErrors()), Logger::LEVEL_INFO, 'MysteriousInvestigateSurvey');
                throw new Exception('现场问卷-基础信息-保存失败', 202);
            }
            $transaction->commit();
        }catch(Exception $e){
            $transaction->rollBack();
            self::jsonFormatOutput(201, '现场问卷保存失败');
        }
    }

    /**
        * @synopsis      电话问卷数据导出
        * @param         string id 用户的ID
        * @return        excel
     */
    public function actionExportMysteriousTelephoneSurvey()
    {
        if (Yii::$app->user->isGuest || 'mysterious' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        //$id = Yii::$app->request->post('id', 0);
        $id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $model = new ModMysteriousTelephoneSurvey();
            $tmpData = $model->getDb()->createCommand('SELECT * FROM tblMysteriousTelephoneSurvey WHERE `ID` = :ID')
                ->bindValues([':ID'=>$id])
                ->queryOne();
            $userData[] = $tmpData;
        }else{
            $userData = ModMysteriousTelephoneSurvey::find()->orderBy('AddTime')->asArray()->all();
        }

        // 组装数据
        $questionData = ModMysteriousQuestion::find()->where(['SurveyType'=>1])->asArray()->all();
        $answerData = ModMysteriousAnswer::find()->orderBy('Sort')->asArray()->all();

        $questionArr = [];
        $questionArr['ID'] = '序号';
        $questionArr['Name'] = '姓名';
        $answerArr = [];
        foreach($questionData as $k =>$v){
            $questionArr[$v['Num']] = $v['Num'].':'.$v['Content'];
        }
        $questionArr['AddTime'] = '调查时间';
        foreach($answerData as $k => $v){
            $answerArr[$v['ID']] = $v['Content'];
        }

        foreach($userData as $k => $singleUserData){
            foreach($singleUserData as $kk => $v){
                if($answerArr[$v] && $kk !='ID' && $kk != 'Name' && $kk != 'AddTime'){
                    $userData[$k][$kk] = iconv('utf8', 'gbk', $answerArr[$v]);
                }
            }
        }

        $header = $questionArr;
        $data = $userData;
        self::exportCSVFromArray($header, $data, '神秘问卷-电话问卷报表'); 
    }
    
    /**
        * @synopsis      回访问卷数据导出
        * @param         string id 用户的ID
        * @return        excel
     */
    public function actionExportMysteriousCallbackSurvey()
    {
        if (Yii::$app->user->isGuest || 'mysterious' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        //$id = Yii::$app->request->post('id', 0);
        $id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $model = new ModMysteriousCallbackSurvey();
            $tmpData = $model->getDb()->createCommand('SELECT * FROM tblMysteriousCallbackSurvey WHERE `ID` = :ID')
                ->bindValues([':ID'=>$id])
                ->queryOne();
            $userData[] = $tmpData;
        }else{
            $userData = ModMysteriousCallbackSurvey::find()->orderBy('AddTime')->asArray()->all();
        }

        // 组装数据
        $questionData = ModMysteriousQuestion::find()->where(['SurveyType'=>2])->asArray()->all();
        $answerData = ModMysteriousAnswer::find()->orderBy('Sort')->asArray()->all();

        $questionArr = [];
        $questionArr['ID'] = '序号';
        $questionArr['Name'] = '姓名';
        $answerArr = [];
        foreach($questionData as $k =>$v){
            $questionArr[$v['Num']] = $v['Num'].':'.$v['Content'];
        }
        $questionArr['AddTime'] = '调查时间';
        foreach($answerData as $k => $v){
            $answerArr[$v['ID']] = $v['Content'];
        }

        foreach($userData as $k => $singleUserData){
            foreach($singleUserData as $kk => $v){
                if($answerArr[$v] && $kk !='ID' && $kk != 'Name' && $kk != 'AddTime'){
                    $userData[$k][$kk] = iconv('utf8', 'gbk', $answerArr[$v]);
                }
            }
        }

        $header = $questionArr;
        $data = $userData;
        self::exportCSVFromArray($header, $data, '神秘问卷-回访问卷报表'); 
    }

    /**
        * @synopsis      现场问卷数据导出
        * @param         string id 用户的ID
        * @return        excel
     */
    public function actionExportMysteriousInvestigateSurvey()
    {
        if (Yii::$app->user->isGuest || 'mysterious' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        //$id = Yii::$app->request->post('id', 0);
        $id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $sql = "
                SELECT * , i.`ID` AS ID
                FROM tblMysteriousInvestigateInfo i
                LEFT JOIN tblMysteriousInvestigateSurvey s ON i.`SurveyID` = s.`ID`
                WHERE i.`ID` = :ID";
            $model = new ModMysteriousInvestigateInfo();
            $tmpData = $model->getDb()->createCommand($sql, [':ID'=>$id])->queryOne();
            $userData[] = $tmpData;
        }else{
            $sql = "
                SELECT * , i.`ID` AS ID
                FROM tblMysteriousInvestigateInfo i
                LEFT JOIN tblMysteriousInvestigateSurvey s ON i.`SurveyID` = s.`ID`";
            $model = new ModMysteriousInvestigateInfo();
            $userData = $model->getDb()->createCommand($sql)->queryAll();
        }

        // 组装数据
        $questionData = ModMysteriousQuestion::find()->where(['SurveyType'=>3])->asArray()->all();
        $answerData = ModMysteriousAnswer::find()->orderBy('Sort')->asArray()->all();
        $dictData = ModMysteriousInvestigateDict::find()->asArray()->all();

        $header = [
            'ID' => '序号',
            'OwnerIDNum' => '车主身份证后六位',
            'OwnerAge' => '车主年龄',
            'OwnerSex' => '车主性别',
            'OwnerConcerns' => '车主购车关注点',
            'OwnerStorePhone' => '车主留店电话',
            'OwnerPhone' => '车主手机号码',
            'OwnerDrivenCar1' => '车主所开车型',
            'OwnerBeginDay' => '车主调查日期',
            'OwnerBeginHour' => '车主开始时间(小时)',
            'OwnerBeginMinus' => '车主开始时间(分钟)',
            'OwnerEndHour' => '车主结束时间(小时)',
            'OwnerEndMinus' => '车主结束时间(分钟)',
            'OwnerName' => '执行车主姓名',
            'OwnerReceptionistName' => '车主接待销售顾问姓名',
            'OwnerReceptionistSex' => '车主接待销售顾问性别',
            'OwnerObjectiveCar' => '车主目标购买车型',
            'OwnerObjectiveCarSituation' => '车主目标购买车型情况',
            'OwnerWayIntoShop' => '车主进店方式',
            'OwnerDrivenCar2' => '车主所开车型',
            'EvaIDNum' => '评估员-身份证',
            'EvaAge' => '评估员-年龄',
            'EvaSex' => '评估员-性别',
            'EvaConcerns' => '评估员-购车关注点',
            'EvaStorePhone' => '评估员-留店电话',
            'EvaPhone' => '评估员-手机号码',
            'EvaDrivenCar1' => '评估员-所开车型',
            'EvaBeginDay' => '评估员-调查日期',
            'EvaBeginHour' => '评估员开始时间(小时)',
            'EvaBeginMinus' => '评估员开始时间(分钟)',
            'EvaEndHour' => '评估员结束时间(小时)',
            'EvaEndMinus' => '评估员结束时间(分钟)',
            'EvaName' => '评估员-姓名',
            'EvaReceptionistName' => '评估员-接待销售顾问姓名',
            'EvaReceptionistSex' => '评估员-接待销售顾问性别',
            'EvaObjectiveCar' => '评估员-目标购买车型',
            'EvaObjectiveCarSituation' => '评估员-目标购买车型情况',
            'EvaWayIntoShop' => '评估员-进店方式',
            'EvaDrivenCar2' => '评估员-所开车型',
            'AddTime' => '表单创建时间'
        ];
        $questionArr = [];
        $answerArr = [];
        $dictArr = [];
        foreach($questionData as $k =>$v){
            $questionArr[$v['Num']] = $v['Num'].':'.$v['Content'];
        }
        foreach($answerData as $k => $v){
            $ansierArr[$v['ID']] = $v['Content'];
        }
        foreach($dictData as $k => $v){
            $dictArr[$v['name']][$v['key']] = $v['content'];
        }

        foreach($userData as $k => $singleUserData){
            foreach($singleUserData as $kk => $v){
                if(false !== strpos($kk,'Sex')){
                    $userData[$k][$kk] = iconv('utf8', 'gbk', $dictArr['Sex'][$v]);
                    continue;
                }
                if(false !== strpos($kk,'ObjectiveCarSituation')){
                    $userData[$k][$kk] = iconv('utf8', 'gbk', $dictArr['ObjectiveCarSituation'][$v]);
                    continue;
                }
                if(false !== strpos($kk,'ObjectiveCar')){
                    $userData[$k][$kk] = iconv('utf8', 'gbk', $dictArr['ObjectiveCar'][$v]);
                    continue;
                }
                if(false !== strpos($kk,'WayIntoShop')){
                    $userData[$k][$kk] = iconv('utf8', 'gbk', $dictArr['WayIntoShop'][$v]);
                    continue;
                }
                if(false !== strpos($kk,'Concerns')){
                    $userData[$k][$kk] = iconv('utf8', 'gbk', $dictArr['Concerns'][$v]);
                    continue;
                }
                if($answerArr[$v] && $kk !='ID' && $kk != 'AddTime'){
                    // 对E10a这个多选题做特殊处理
                    if('E10a' == $userData[$k][$kk]){
                        $answerArrNum = explode(',', $v);
                        foreach($answerArrNum as $vv){
                            $answerArrData .= iconv('utf8', 'gbk', $answerArr[$vv]).'、';
                        }
                        $userData[$k][$kk] = $answerArrData;
                        continue;
                    }
                    $userData[$k][$kk] = iconv('utf8', 'gbk', $answerArr[$v]);
                    // 如果有附加文字要加上
                    if($userData[$k][$kk.'Text']){
                        $userData[$k][$kk] .= iconv('utf8', 'gbk', '：'.$userData[$k][$kk.'Text']);
                    }
                }
            }
        }

        $header = array_merge($header, $questionArr);
        $data = $userData;
        self::exportCSVFromArray($header, $data, '神秘问卷-现场调查问卷报表'); 
    }
    
    /**
        * @synopsis      规范式JSON格式输出
        * @param         $code     状态位
        * @param         $message  信息
        * @param         $data     数据
        * @return        json 
     */
    private static function jsonFormatOutput($code, $message, $data = [])
    {
        $res = ['code'=>$code, 'msg'=>$message, 'data'=>$data];
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
        Yii::$app->end();
    }

    /**
     * 输出CSV报表
     * @param array  $header    表头数据，索引、关联数组均可
     * @param array  $data      表格数据，二维数组
     * @param string $filename  输出文件名
     * @param int    $limit     刷新buffer频率，每输出$limit行，清空一次buffer
     */
    private static function exportCSVFromArray($header,$data,$filename='报表',$limit='4000'){

        header('Content-type:text/csv;charset=UTF-8');
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment;Filename=$filename.csv");
        if (preg_match("/MSIE/", $_SERVER["HTTP_USER_AGENT"])) {
            $filename = urlencode($filename);
        }

        $fp  = fopen("php://output",'a+');
        //fwrite($fp, chr(0XEF) . chr(0xBB) . chr(0XBF)); //去BOM头
        $cnt = 0 ;              //计数器

        foreach ($header as $i => $v) {
            $header[$i] = iconv('utf-8','gbk', $v);
        }

        fputcsv($fp, $header);  //写表头
        foreach($data as $v){
            fputcsv($fp, $v);
            $cnt++;
            if($limit == $cnt){ //清空缓存
                ob_flush();     //刷新PHP自身缓存区
                flush();        //在Apache下才起作用，刷新Apache的缓冲区，我们的环境是Nginx，为兼容，配套使用。
                $cnt = 0;
            }
        }
        fclose($fp);
    }
}
