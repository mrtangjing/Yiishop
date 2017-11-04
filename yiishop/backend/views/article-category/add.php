<?php
$feom = \yii\bootstrap\ActiveForm::begin();
echo $feom->field($cate,'name');
echo $feom->field($cate,'sort');
echo $feom->field($cate,'status')->inline()->radioList(\backend\models\ArticleCategory::$status);
echo $feom->field($cate,'is_help')->inline()->radioList(\backend\models\ArticleCategory::$is_help);
echo $feom->field($cate,'intro')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['add'],['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();