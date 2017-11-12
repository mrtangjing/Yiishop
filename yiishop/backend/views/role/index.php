<?php
/* @var $this yii\web\View */
?>
<h1>权限列表</h1>
<?= \yii\bootstrap\Html::a('添加角色',['add'],['class'=>'btn btn-success'])?>

<table class="table table-hover">
    <tr>
        <th>角色名称</th>
        <th>角色描述</th>
        <th>权限</th>
        <th>操作</th>
    </tr>
    <?php foreach ($roles as $v):?>
        <tr>
            <td>
                <?= strpos($v->name,"/")?"---":"";?><?=$v->name?>
            </td>

            <td><?=$v->description?></td>
            <td>
                <?php
                $auth=Yii::$app->authManager;
                //得到当前角色所有权限
                $pers= $auth->getPermissionsByRole($v->name);
                    $arr="";
                foreach ($pers as $per){
                    $arr.=$per->description.'||';
                }
                echo rtrim($arr,'||');
                ?>
            </td>
            <td><?=\yii\bootstrap\Html::a('修改角色',['edit','name'=>$v->name],['class'=>'btn btn-info'])?>
           <?=\yii\bootstrap\Html::a('删除角色',['del','name'=>$v->name],['class'=>'btn btn-success'])?></td>
        </tr>
    <?php endforeach;?>

</table>


