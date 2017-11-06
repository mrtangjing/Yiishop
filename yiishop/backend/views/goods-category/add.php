<?php
$from =\yii\bootstrap\ActiveForm::begin();
echo $from->field($model,'name');
echo $from->field($model,'parent_id')->hiddenInput();

echo  \liyuze\ztree\ZTree::widget([
    'setting' => '{
        
            callback: {
		onClick:function(event, treeId, treeNode){
		console.dir(treeNode);
		   $("#goodscategory-parent_id").val(treeNode.id);
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
    'nodes' => $cates,

]);
//var_dump($cates);
echo $from->field($model,'intro')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['add'],['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();