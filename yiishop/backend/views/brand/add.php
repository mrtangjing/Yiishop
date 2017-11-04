<?php
$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($brand, 'name');
echo $form->field($brand, 'srot');
echo $form->field($brand, 'status')->inline()->radioList(\backend\models\Brand::$status);
echo $form->field($brand, 'intor')->textarea();

if ($brand->logo) {
    echo $form->field($brand, 'logo')->widget('manks\FileInput', []);;
//    echo '<div>' . \yii\bootstrap\Html::img('@web/' . $brand->logo, ['height' => 100]) . '</div>';
    echo '<p>' . \yii\bootstrap\Html::submitButton('品牌修改', ['class' => 'btn btn-success']) . '</p>';
    \yii\bootstrap\ActiveForm::end();
} else {
    echo $form->field($brand, 'logo')->widget('manks\FileInput', []);
    echo "<br/>";
    echo \yii\bootstrap\Html::submitButton('品牌添加', ['class' => 'btn btn-success']);
    \yii\bootstrap\ActiveForm::end();
}

