<?= \yii\bootstrap\Html::a('添加品牌', ['add'], ['class' => 'btn btn-success']); ?>
<?= \yii\bootstrap\Html::a('回收箱', ['remov'], ['class' => 'btn btn-info']); ?>
<table class="table table-hover">
    <style>
        .green {
            color: green;
        }

        .red {
            color: red;
        }
    </style>
    <tr>
        <th>品牌名称</th>
        <th>品牌logo</th>
        <th>品牌简介</th>
        <th>排序</th>
        <th>品牌状态</th>
        <th>品牌创建时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($brands as $brand): ?>
        <tr>
            <td><?= $brand->name ?></td>
            <td>
                <img src="<?=$brand->images ?>" alt="" class="img-circle" style="height: 30px;">
            </td>
            <td><?= $brand->intor ?></td>
            <td><?= $brand->srot ?></td>
            <td><span class="glyphicon glyphicon-<?= $brand->status ? 'ok green ' : 'remove red  ' ?>"></span></td>
            <td><?= date('Y-m-d h:i:s', $brand->create_time) ?></td>
            <td>
                <?= \yii\bootstrap\Html::a('编辑品牌', ['edit', 'id' => $brand->id], ['class' => 'btn btn-info']); ?>
                <?= \yii\bootstrap\Html::a('删除品牌', ['del', 'id' => $brand->id], ['class' => 'btn btn-danger']); ?>
            </td>
        </tr>

    <?php endforeach; ?>
</table>
<p class="content"><?= \yii\widgets\LinkPager::widget([
        'pagination' => $page,
    ]); ?>
</p>
