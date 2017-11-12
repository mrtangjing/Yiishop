<?php
/* @var $this yii\web\View */
?>
<h1>权限列表</h1>
<?= \yii\bootstrap\Html::a('添加权限',['add'],['class'=>'btn btn-success'])?>

<table class="table table-hover">
    <tr>
        <th>权限名称</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($authItem as $v):?>
        <tr>
            <td>
                <?= strpos($v->name,"/")?"---":"";?><?=$v->name?>
            </td>

            <td><?=$v->description?></td>
            <td><?=\yii\bootstrap\Html::a('修改权限',['edit','name'=>$v->name],['class'=>'btn btn-info'])?>
           <?=\yii\bootstrap\Html::a('删除权限',['del','name'=>$v->name],['class'=>'btn btn-success'])?></td>
        </tr>
    <?php endforeach;?>

</table>


