<?php

namespace app\controllers;

use Yii;
use app\models\ModNpsSalesSurvey;
use app\models\ModNpsAfterSalesSurvey;
use app\models\ModNpsSalesSurveySearch;
use app\models\ModNpsQuestion;
use app\models\ModNpsAnswer;
use app\models\ModNpsQuestionAnswerMap;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\log\Logger;
use yii\filters\VerbFilter;

class NpsSurveyController extends Controller
{
    public $enableCsrfValidation = false;
    /**
        * @synopsis   获取NPS问卷内容
        * @param      string type 类型 1-销售问卷 2-售后问卷
        * @return     json 
     */
    public function actionGetSurveyData()
    {
        //$type = Yii::$app->request->post('type');
        $type = Yii::$app->request->get('type');
        // 1-销售问卷 2-售后问卷
        if( '1' === $type){
            $surveyType = 1;
        }elseif('2' === $type){
            $surveyType = 2;
        }else{
            self::jsonFormatOutput(201, '获取问卷失败-问卷类型获取失败');
        }

        // 获取数据
        $questionData = ModNpsQuestion::find()->where(['SurveyType'=>$surveyType])->asArray()->all();
        $answerData = ModNpsAnswer::find()->orderBy('Sort')->asArray()->all();
        $mapData = ModNpsQuestionAnswerMap::find()->asArray()->all();

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
                'ID' => $v['ID'],
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

        $reloadData = [];
        foreach($data as $k => $v){
            $reloadData[] = $v;
        }

        self::jsonFormatOutput(200, '获取问卷成功', $reloadData);

    }

    /**
        * @synopsis     销售问卷保存 
        * @param        见接口文档 
        * @return       json  
     */
    public function actionSaveNpsSalesSurvey()
    {
        $model = new ModNpsSalesSurvey();
        $post = Yii::$app->request->post();
        $post['AddTime'] = date('Y-m-d H:i:s');
        if ($model->load($post, 1) && $model->save()) {
            self::jsonFormatOutput(200, '销售问卷保存成功');
        }else{
            Yii::getLogger()->log(json_encode($model->getErrors()), Logger::LEVEL_INFO, 'NpsSalesSurvey');
            self::jsonFormatOutput(201, '销售问卷保存失败');
        }
    }

    /**
        * @synopsis     售后问卷保存 
        * @param        见接口文档 
        * @return       json  
     */
    public function actionSaveNpsAfterSalesSurvey()
    {
        $model = new ModNpsAfterSalesSurvey();
        $post = Yii::$app->request->post();
        $post['AddTime'] = date('Y-m-d H:i:s');
        if ($model->load($post, 1) && $model->save()) {
            self::jsonFormatOutput(200, '售后问卷保存成功');
        }else{
            Yii::getLogger()->log(json_encode($model->getErrors()), Logger::LEVEL_INFO, 'NpsAfterSalesSurvey');
            self::jsonFormatOutput(201, '售后问卷保存失败');
        }
    }

    /**
        * @synopsis      NPS销售问卷数据查看
        * @param         string id 用户的ID
        * @return        excel
     */
    public function actionGetNpsSalesInfo()
    {
        // 判断是否登陆以及权限控制
        if (Yii::$app->user->isGuest || 'nps' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        $id = Yii::$app->request->post('ID', 0);
        //$id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $model = new ModNpsSalesSurvey();
            $userData = $model->getDb()->createCommand('SELECT * FROM tblNpsSalesSurvey WHERE `ID` = :ID')
                ->bindValues([':ID'=>$id])
                ->queryOne();
        }else{
            self::jsonFormatOutput(201, '缺少id参数');
        }

        // 组装数据
        $questionData = ModNpsQuestion::find()->where(['SurveyType'=>1])->asArray()->all();
        $answerData = ModNpsAnswer::find()->orderBy('Sort')->asArray()->all();

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

            foreach($userData as $k => $v){
                if($answerArr[$v] && $k != 'AddTime' && $k != 'ID' && $k != 'Name'){
                    $userData[$k] = $answerArr[$v];
                    // 如果有附加文字要加上
                    // if($userData[$k.'Other']){
                    //     $userData[$k] .=  '：'.$userData[$k.'Other'];
                    // }
                }
            }

        $header = $questionArr;

        // foreach($header as  $k => $v){
        //     $data[$v] = $userData[$k];     
        // }
        self::jsonFormatOutput(200, '信息获取成功', ['header'=>$header, 'data'=>$userData]);
    }

    /**
        * @synopsis      NPS售后问卷数据查看
        * @param         string id 用户的ID
        * @return        excel
     */
    public function actionGetNpsAfterSalesInfo()
    {
        // 判断是否登陆以及权限控制
        if (Yii::$app->user->isGuest || 'nps' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        $id = Yii::$app->request->post('ID', 0);
        //$id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $model = new ModNpsAfterSalesSurvey();
            $userData = $model->getDb()->createCommand('SELECT * FROM tblNpsAfterSalesSurvey WHERE `ID` = :ID')
                ->bindValues([':ID'=>$id])
                ->queryOne();
        }else{
            self::jsonFormatOutput(201, '缺少id参数');
        }

        // 组装数据
        $questionData = ModNpsQuestion::find()->where(['SurveyType'=>2])->asArray()->all();
        $answerData = ModNpsAnswer::find()->orderBy('Sort')->asArray()->all();

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

            foreach($userData as $k => $v){
                if($answerArr[$v] && $k != 'AddTime' && $k != 'ID' && $k != 'Name'){
                    $userData[$k] = $answerArr[$v];
                    // 如果有附加文字要加上.
                    // if($userData[$k.'Other']){
                    //     $userData[$k] .=  '：'.$userData[$k.'Other'];
                    // }
                }
            }

        $header = $questionArr;

        // foreach($header as  $k => $v){
        //     $data[$v] = $userData[$k];     
        // }
        self::jsonFormatOutput(200, '信息获取成功', ['header'=>$header, 'data'=>$userData]);
    }

    /**
        * @synopsis      NPS销售问卷数据导出
        * @param         string id 用户的ID
        * @return        excel
     */
    public function actionExportNpsSalesSurvey()
    {
        // 判断是否登陆以及权限控制
        if (Yii::$app->user->isGuest || 'nps' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        $id = Yii::$app->request->post('ID', 0);
        //$id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $model = new ModNpsSalesSurvey();
            $tmpData = $model->getDb()->createCommand('SELECT * FROM tblNpsSalesSurvey WHERE `ID` = :ID')
                ->bindValues([':ID'=>$id])
                ->queryOne();
            $userData[] = $tmpData;
        }else{
            $userData = ModNpsSalesSurvey::find()->orderBy('AddTime')->asArray()->all();
        }

        // 组装数据
        $questionData = ModNpsQuestion::find()->where(['SurveyType'=>1])->asArray()->all();
        $answerData = ModNpsAnswer::find()->orderBy('Sort')->asArray()->all();

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
                    // 如果有附加文字要加上
                    if($userData[$k][$kk.'Other']){
                        $userData[$k][$kk] .= iconv('utf8', 'gbk', '：'.$userData[$k][$kk.'Other']);
                    }
                }
            }
        }

        

        $header = $questionArr;
        $data = $userData;
        foreach($data as $k => $v){
            foreach($v as $kk => $vv){
                if(false !== strpos($kk, 'A42A')){
                    $data[$k]['A42A'] .= $vv. iconv('utf8', 'gbk', ';');
                }
                if(false !== strpos($kk, 'A42B')){
                    $data[$k]['A42B'] .= $vv. iconv('utf8', 'gbk', ';');
                }

            }
        }
        self::exportCSVFromArray($header, $data, 'NPS问卷-销售问卷报表'); 
    }

    /**
        * @synopsis      NPS售后问卷数据导出
        * @param         string id 用户的ID
        * @return        excel
     */
    public function actionExportNpsAfterSalesSurvey()
    {
        // 判断是否登陆以及权限控制
        if (Yii::$app->user->isGuest || 'nps' !== Yii::$app->user->identity->type) {
            self::jsonFormatOutput(210, '非法访问');
        }
        $id = Yii::$app->request->post('id', 0);
        //$id = Yii::$app->request->get('id', 0);
        $userData = [];
        if($id){
            $model = new ModNpsAfterSalesSurvey();
            $tmpData = $model->getDb()->createCommand('SELECT * FROM tblNpsAfterSalesSurvey WHERE `ID` = :ID')
                ->bindValues([':ID'=>$id])
                ->queryOne();
            $userData[] = $tmpData;
        }else{
            $userData = ModNpsAfterSalesSurvey::find()->orderBy('AddTime')->asArray()->all();
        }

        // 组装数据
        $questionData = ModNpsQuestion::find()->where(['SurveyType'=>2])->asArray()->all();
        $answerData = ModNpsAnswer::find()->orderBy('Sort')->asArray()->all();

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
                    // 如果有附加文字要加上
                    if($userData[$k][$kk.'Other']){
                        $userData[$k][$kk] .= iconv('utf8', 'gbk', '：'.$userData[$k][$kk.'Other']);
                    }
                }
            }
        }

        $header = $questionArr;
        $data = $userData;

        self::exportCSVFromArray($header, $data, 'NPS问卷-售后问卷报表'); 
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
