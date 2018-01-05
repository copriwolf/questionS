<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModNpsSalesSurvey */

$this->title = 'Update Mod Nps Sales Survey: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Mod Nps Sales Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mod-nps-sales-survey-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
