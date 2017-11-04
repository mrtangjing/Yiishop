<?php
/* @var $this yii\web\View */
?>
<h1>文章分类</h1>
<?=\yii\bootstrap\Html::a('添加分类',['add'],['class'=>'btn btn-success'])?>
<table class="table">
    <style>
        .grenn{
            color: gold;
        }
        .red{
            color: #00aa00;
        }
    </style>
    <tr>
        <th>文章分类名称</th>
        <th>文章排序</th>
        <th>文章状态</th>
        <th>文章简介</th>
        <th>是否帮助</th>
        <th>操作</th>
    </tr>
    <?php foreach ($cate as $v):?>
        <tr>
            <td><?=$v->name?></td>
            <td><?=$v->sort?></td>
            <td class="glyphicon glyphicon-<?=$v->status?'ok grenn':'remove red'?>"></td>
            <td><?=$v->intro?></td>
            <td class="glyphicon glyphicon-<?=$v->is_help?'ok grenn':'remove red'?>"></td>
            <td>

                <?=\yii\bootstrap\Html::a('编辑分类',['edit','id'=>$v->id],['class'=>'btn btn-info'])?>
                <?=\yii\bootstrap\Html::a('删除分类',['del','id'=>$v->id],['class'=>'btn btn-danger'])?>

            </td>
        </tr>
    <?php endforeach;?>

</table>

