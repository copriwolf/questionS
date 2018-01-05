<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModNpsSalesSurveySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mod-nps-sales-survey-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'Phone') ?>

    <?= $form->field($model, 'S1') ?>

    <?= $form->field($model, 'S1Other') ?>

    <?php // echo $form->field($model, 'S2') ?>

    <?php // echo $form->field($model, 'S2Other') ?>

    <?php // echo $form->field($model, 'S3') ?>

    <?php // echo $form->field($model, 'S4') ?>

    <?php // echo $form->field($model, 'S5') ?>

    <?php // echo $form->field($model, 'A1') ?>

    <?php // echo $form->field($model, 'A2') ?>

    <?php // echo $form->field($model, 'A3') ?>

    <?php // echo $form->field($model, 'A31') ?>

    <?php // echo $form->field($model, 'A42A1') ?>

    <?php // echo $form->field($model, 'A42A2') ?>

    <?php // echo $form->field($model, 'A42A3') ?>

    <?php // echo $form->field($model, 'A42A4') ?>

    <?php // echo $form->field($model, 'A42A5') ?>

    <?php // echo $form->field($model, 'A42B1') ?>

    <?php // echo $form->field($model, 'A42B2') ?>

    <?php // echo $form->field($model, 'A42B3') ?>

    <?php // echo $form->field($model, 'A42B4') ?>

    <?php // echo $form->field($model, 'A42B5') ?>

    <?php // echo $form->field($model, 'C1') ?>

    <?php // echo $form->field($model, 'C2') ?>

    <?php // echo $form->field($model, 'C3') ?>

    <?php // echo $form->field($model, 'C3Other') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
