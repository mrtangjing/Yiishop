<h1>文章列表</h1>
<?= \yii\bootstrap\Html::a('添加文章', ['add'], ['class' => 'btn btn-success']) ?>
<table class="table">
    <style>
        .green{
            color: #00a2d4;
        }
        .red{
            color: red;
        }
    </style>
    <tr>
        <th>文章名称</th>
        <th>文章分类</th>
        <th>文章排序</th>
        <th>文章状态</th>
        <th>文章简介</th>
        <th>文章上传时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($artic as $v): ?>
        <tr>
            <td><?= $v->name ?></td>
            <td><?=$v->category ?></td>
            <td><?= $v->sort ?></td>
            <td class="glyphicon glyphicon-<?= $v->status ? 'ok grenn' : 'remove red' ?>"></td>
            <td><?= $v->intro ?></td>
            <td><?= date('Y-m-d h:i:s', $v->inputtime) ?></td>
            <td>
                <?= \yii\bootstrap\Html::a('查看内容', ['show', 'id' => $v->id], ['class' => 'btn btn-danger']) ?>
                <?= \yii\bootstrap\Html::a('编辑文章', ['edit', 'id' => $v->id], ['class' => 'btn btn-info']) ?>
                <?= \yii\bootstrap\Html::a('编辑删除', ['del', 'id' => $v->id], ['class' => 'btn btn-danger']) ?></td>
        </tr>


    <?php endforeach; ?>
</table>

