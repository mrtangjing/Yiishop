<?php
/* @var $this yii\web\View */
?>
<h1>用户列表</h1>
<?= \yii\bootstrap\Html::a('添加用户',['add'], ['class' => 'btn btn-success']) ?>
<table class="table table-hover">
    <tr>
        <th>用户名</th>
        <th>用邮箱</th>
        <th>注册时间</th>
        <th>登录时间</th>
        <th>登录IP</th>
        <th>操作</th>
    </tr>
    <?php foreach ($admin as $v):?>
        <tr>
            <td><?=$v->username?></td>
            <td><?=$v->email?></td>
            <td><?=date('Y-m-d h:i:s',$v->add_time)?></td>
            <td><?=date('Y-m-d h:i:s',$v->last_login_time)?></td>
            <td><?=$v->last_login_ip?></td>
            <td>
                <?=\yii\bootstrap\Html::a('编辑',['edit','id'=>$v->id],['class'=>'btn btn-info'])?>
                <?=\yii\bootstrap\Html::a('删除',['del','id'=>$v->id],['class'=>'btn btn-danger'])?>
            </td>
        </tr>

    <?php endforeach;?>
</table>

