<?php
use leandrogehlen\treegrid\TreeGrid;
?>

    <h1>商品分类列表</h1>

<?php
echo   \yii\bootstrap\Html::a('添加分类',['add'],['class'=>'btn btn-success']);

echo  TreeGrid::widget([
    'dataProvider' =>$category,
    'keyColumnName' => 'id',
    'parentColumnName' => 'parent_id',
    'parentRootValue' => '0', //first parentId value
    'pluginOptions' => [
        'initialState' => 'collapsed',
    ],
    'columns' => [
        'id',
        'name',
        'parent_id',
        ['class' => 'yii\grid\ActionColumn']
    ]
]);


?>