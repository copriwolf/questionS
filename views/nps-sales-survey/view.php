<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ModNpsSalesSurvey */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Mod Nps Sales Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-nps-sales-survey-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'Name',
            'Phone',
            'S1',
            'S1Other',
            'S2',
            'S2Other',
            'S3',
            'S4',
            'S5',
            'A1',
            'A2',
            'A3',
            'A31',
            'A42A1',
            'A42A2',
            'A42A3',
            'A42A4',
            'A42A5',
            'A42B1',
            'A42B2',
            'A42B3',
            'A42B4',
            'A42B5',
            'C1',
            'C2',
            'C3',
            'C3Other',
        ],
    ]) ?>

</div>
