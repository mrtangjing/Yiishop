<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login ">


    <div class="row">
        <div class="col-lg-4 pull-right">
            <p style="font-size: 30px;">管理员登录</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($login, 'username')->textInput(['size'=>20,'placeholder'=>"请输入用户名"]) ?>

                <?= $form->field($login, 'password')->passwordInput(['placeholder'=>"请输入用户密码"]) ?>

                <?= $form->field($login, 'rememberMe')->checkbox() ?>
            <div class="form-group">

                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
