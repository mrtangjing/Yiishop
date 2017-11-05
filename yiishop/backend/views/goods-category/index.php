<?php
/* @var $this yii\web\View */
?>
<h1>商品分类列表</h1>
<?=\yii\bootstrap\Html::a('添加分类',['add'],['class'=>'btn btn-success'])?>
<table class="table table-hover">
    <tr>
        <th>分类ID</th>
        <th>分类名称</th>
        <th>分类简介</th>
        <th>操作</th>

    </tr>
    <?php foreach ($category as $cate):?>
        <tr>
            <td><?=$cate->id?></td>
            <td><?=$cate->name?></td>
            <td><?=$cate->intro?></td>
            <td><?=\yii\bootstrap\Html::a('编辑',['edit','id'=>$cate->id],['class'=>'btn btn-info'])?></td>
            <td><?=\yii\bootstrap\Html::a('删除',['del','id'=>$cate->id],['class'=>'btn btn-danger'])?></td>
        </tr>

    <?php endforeach; ?>

</table>

