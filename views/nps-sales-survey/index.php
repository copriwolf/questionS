<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModNpsSalesSurveySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mod Nps Sales Surveys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-nps-sales-survey-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mod Nps Sales Survey', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            'Name',
            'Phone',
            'S1',
            'S1Other',
            // 'S2',
            // 'S2Other',
            // 'S3',
            // 'S4',
            // 'S5',
            // 'A1',
            // 'A2',
            // 'A3',
            // 'A31',
            // 'A42A1',
            // 'A42A2',
            // 'A42A3',
            // 'A42A4',
            // 'A42A5',
            // 'A42B1',
            // 'A42B2',
            // 'A42B3',
            // 'A42B4',
            // 'A42B5',
            // 'C1',
            // 'C2',
            // 'C3',
            // 'C3Other',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
