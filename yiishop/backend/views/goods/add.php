<?php
//var_dump($model);die();
//var_dump($img);die();
//var_dump($intro);die();
$from = \yii\bootstrap\ActiveForm::begin();
echo $from->field($model,'name');
echo $from->field($model,'sort');
echo $from->field($model,'brand_id')->dropDownList($brands);
//echo $from->field($model,'sn');
echo $from->field($model,'goods_category_id');
echo  \liyuze\ztree\ZTree::widget([
    'setting' => '{

            callback: {
		onClick:function(event, treeId, treeNode){
		console.dir(treeNode);
		   $("#goods-goods_category_id").val(treeNode.id);
		},
	},
			data: {
				simpleData: {
					enable: true,
					idKey: "id",
			        pIdKey: "parent_id",

			        rootPId: 0
				}
			}
		}',
    'nodes' => $goodsCate,

]);
echo $from->field($model,'market_price');
echo $from->field($model,'shop_price');
echo $from->field($model,'stock');
echo $from->field($model,'is_on_sale')->inline()->radioList(\backend\models\Goods::$isSale);
echo $from->field($model,'status')->inline()->radioList(\backend\models\Goods::$status);
echo $from->field($model, 'logo')->widget('manks\FileInput', []);
echo $from->field($model, 'imgPath')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
         'server' => \yii\helpers\Url::to(['brand/upload']),
         'accept' => [
         	'extensions' => ['png','jpg','gif'],
         ],
    ]
    ]);


echo $from->field($intro,'content')->widget('kucha\ueditor\UEditor',[]);

echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();