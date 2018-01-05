<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '宝马问卷调查后台';
//$this->params['breadcrumbs'][] = $this->title;
?>

<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>宝马问卷调查后台</title>
    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!--[if IE]>
    <script src="http://libs.baidu.com/html5shiv/3.7/html5shiv.min.js"></script>
    <![endif]-->
</head>
<body>
<article class="htmleaf-container">
    <header class="htmleaf-header">
        <h1>宝马问卷调查后台</h1>
        <div class="htmleaf-links">
        </div>
    </header>
    <div class="panel-lite">
        <div class="thumbur">
            <div class="icon-lock"></div>
        </div>
        <h4>用户登录</h4>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'fieldConfig' => [
        ],
    ]); ?>
        <div class="form-group">

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('用户名') ?>
        <?= $form->field($model, 'password')->passwordInput()->label('密码') ?>
        <?= $form->field($model, 'rememberMe')->checkbox()->label('是否记住登陆') ?>


            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('<i class="icon-arrow"></i>', ['class' => 'floating-btn', 'name' => 'login-button', 'value' => '<i class="icon-arrow"></i>']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</article>
</body>
</html>
