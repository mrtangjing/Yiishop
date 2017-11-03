<h1>回收箱</h1>
<table class="table table-hover">
    <tr>
        <th>商品名称</th>
        <th>商品排序</th>
        <th>商品logo</th>
        <th>商品状态</th>
        <th>商品简介</th>
        <th>操作</th>
    </tr>
    <?php foreach ($brands as $v):?>
    <tr>
        <td><?=$v->name?></td>
        <td><?=$v->srot?></td>
        <td>
            <?=\yii\bootstrap\Html::img('/'.$v->logo,['width'=>60,'class'=>"img-circle"])?></td>

                <td><span class="glyphicon glyphicon-trash"></td>
                <td><?=$v->intor?></td>
                <td>
                <?=\yii\bootstrap\Html::a('彻底删除',['remov','id'=>$v->id],['class'=>'btn btn-danger'])?>
                </td>
                    </tr>
    <?php endforeach;?>

</table>
<p class="content"><?= \yii\widgets\LinkPager::widget([
        'pagination' => $page,
    ]);?>
</p>