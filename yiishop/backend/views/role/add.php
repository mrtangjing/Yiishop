<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($authItem,'name');
echo $form->field($authItem,'description')->textarea();
echo $form->field($authItem,"permissions")->checkboxList($permissions);
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();