<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModNpsSalesSurvey */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mod-nps-sales-survey-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'S1')->textInput() ?>

    <?= $form->field($model, 'S1Other')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'S2')->textInput() ?>

    <?= $form->field($model, 'S2Other')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'S3')->textInput() ?>

    <?= $form->field($model, 'S4')->textInput() ?>

    <?= $form->field($model, 'S5')->textInput() ?>

    <?= $form->field($model, 'A1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A2')->textInput() ?>

    <?= $form->field($model, 'A3')->textInput() ?>

    <?= $form->field($model, 'A31')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42A1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42A2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42A3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42A4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42A5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42B1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42B2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42B3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42B4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'A42B5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'C1')->textInput() ?>

    <?= $form->field($model, 'C2')->textInput() ?>

    <?= $form->field($model, 'C3')->textInput() ?>

    <?= $form->field($model, 'C3Other')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
