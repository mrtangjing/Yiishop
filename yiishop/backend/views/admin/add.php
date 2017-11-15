<?php
$from = \yii\bootstrap\ActiveForm::begin();
 echo $from->field($admin,'username');
 echo $from->field($admin,'password')->passwordInput();
 echo $from->field($admin,'email');
// echo$from->field($admin,'roles')->inline()->checkboxList($roles);
 echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
 \yii\bootstrap\ActiveForm::end();