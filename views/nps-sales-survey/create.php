<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModNpsSalesSurvey */

$this->title = 'Create Mod Nps Sales Survey';
$this->params['breadcrumbs'][] = ['label' => 'Mod Nps Sales Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mod-nps-sales-survey-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
