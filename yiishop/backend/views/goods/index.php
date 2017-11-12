<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;

?>
    <h1>商品列表</h1>

    <div class="row">
    <div class="col-md-2">
        <?=\yii\bootstrap\Html::a('添加商品',['add'],['class'=>'btn btn-success'])?>
    </div>
        <div class="col-md-10">
            <form class="form-inline pull-right">
                <div class="form-group">
<!--                    <label for="exampleInputName2">Name</label>-->
                    <input type="text" class="form-control"  name="minPrice" placeholder="最低价格" size="10">
                </div>

                <div class="form-group">
<!--                    <label for="exampleInputName2">Name</label>-->
                    <input type="text" class="form-control" name="maxPrice" placeholder="最高价格" size="10">
                </div>
                <div class="form-group">
<!--                    <label for="exampleInputEmail2">Email</label>-->
                    <input type="text" class="form-control" name="keywords" placeholder="请输入搜索关键字" size="">
                </div>
                <button type="submit" class="btn btn-success">搜搜</button>
            </form>
<?php
//            $searchForm=new \backend\models\GoodsSearchForm();
//            $form=\yii\bootstrap\ActiveForm::begin([
//                'method' => 'get',
//                'options' => ['class'=>"form-inline pull-right"]
//            ]);
//            echo $form->field($searchForm,'minPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"理想价格"]);
//            echo "-";
//            echo $form->field($searchForm,'maxPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"最高价格"]);
//            echo " ";
//            echo $form->field($searchForm,'keywords')->label(false)->textInput(['placeholder'=>"请输入搜索关键字"]);
//            echo " ";
//            echo \yii\bootstrap\Html::submitButton("搜索",['class'=>'btn btn-success','style'=>"margin-bottom:8px"]);
//            \yii\bootstrap\ActiveForm::end();
//            ?>
            </div>
    </div>

<table class="table table-hover">
    <tr>
        <th>商品名称</th>
        <th>商品logo</th>
        <th>商品编号</th>
        <th>商品分类</th>
        <th>品牌分类</th>
        <th>市场售价</th>
        <th>店内售价</th>
        <th>商品库存</th>
        <th>是否上架</th>
        <th>是否显示</th>
        <th>商品入库时间</th>
        <th>操作</th>
    </tr>

    <?php foreach ($goods as $goods):?>
        <tr>
            <td><?=$goods->name?></td>
            <td><?=\yii\bootstrap\Html::img($goods->logo,['height'=>'30px'])?></td>
            <td><?=$goods->sn?></td>
            <td><?=$goods->goodsCate->name?></td>
            <td><?=$goods->brand?></td>
            <td><?=$goods->market_price?></td>
            <td><?=$goods->shop_price?></td>
            <td><?=$goods->stock?></td>
            <td><?=$goods->sale?></td>
            <td><?=$goods->statu?></td>
            <td><?=date('Y-m-d h:i:s',$goods->create_time)?></td>
            <td><?= \yii\bootstrap\Html::a('编辑',['edit','id'=>$goods->id],['class'=>'btn btn-info'])?>
             <?=\yii\bootstrap\Html::a('删除',['del','id'=>$goods->id],['class'=>'btn btn-danger'])?></td>
        </tr>




    <?php endforeach;?>

</table>

<?php

echo LinkPager::widget([
    'pagination' => $pages,
]);

?>