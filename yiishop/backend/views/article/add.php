<?php
$feom = \yii\bootstrap\ActiveForm::begin();
echo $feom->field($artic,'name');
echo $feom->field($artic,'article_category_id')->dropDownList($cate);
echo $feom->field($artic,'status')->inline()->radioList(\backend\models\Article::$status);
echo $feom->field($artic,'sort');
echo $feom->field($artic,'intro')->textarea();
echo $feom->field($detail,'content')->textarea();

echo \yii\bootstrap\Html::submitButton('提交',['add'],['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();