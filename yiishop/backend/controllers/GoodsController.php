<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsGallery;
use backend\models\GoodsImg;
use backend\models\GoodsIntro;
use flyok666\qiniu\Qiniu;
use Symfony\Component\Yaml\Yaml;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use \kucha\ueditor\UEditor;
use yii\data\Pagination;
use backend\models\GoodsSearchForm;

class GoodsController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
        ]
        ];
    }
    //商品列表显示
    public function actionIndex()
    {
        //定义每页显示条数
        $count=Goods::find()->count();
        $pageSize=1;
        $pages=new Pagination(
            [
                //传递每页显示的条数
                'pageSize' => $pageSize,
                //传递数据总条数
                'totalCount' => $count,
            ]
        );
        $searchForm=new GoodsSearchForm();
        $goods=Goods::find()->limit($pages->limit)->offset($pages->offset)->all();


        return $this->render('index',compact("pages","goods","searchForm"));
    }

    // 商品添加
    public function actionAdd()
    {
        $goods = new Goods();
        $goodsGallery = new GoodsGallery();
        $goodsIntro = new GoodsIntro();
        $request = \Yii::$app->request;
        if ($request->isPost) {
            if ($goods->load($request->post()) && $goods->validate()) {
                $times = date('Ymd', time());
                //查询每天创建商品表
                $goodsDay = GoodsDayCount::findOne(['day' => $times]);
                //goods_day_count表数据操作
                //没有数据创建对象
                $goodsDays = new GoodsDayCount();
                //判断表里是否有数据
                if (empty($goodsDay)) {
                    //$goodsDay表没有数据进入
                    //保存数据
                    $goodsDays->day = $times;
                    $goodsDays->count = 1;
                    $goodsDays->insert();
                    //拼接订单号
                    $sn = $goodsDays->day . '00000' . $goodsDays->count;
                } else {
                    //$goodsDay有数据取出修改数据
                    $goodsDay->count = $goodsDay->count + 1;
                    $goodsDay->update();
                    $sn = $goodsDay->day . substr('00000' . $goodsDay->count, -6);
                }
//goods 表的数据操作
                //自动生成订单号
                $goods->sn = $sn;
                $goods->create_time = time();
                //保存goods信息
                $goods->save();
            }
//商品内容表操作保存数据
            $intro = $request->post();
            $goodsIntro->load($intro);
            $goodsIntro->goods_id = $goods->id;
            $goodsIntro->save();


//商品图片表操作
            $gallery = $request->post();
            foreach ($gallery['Goods']["imgPath"] as $v) {
                $goodsGallery = new GoodsGallery();
                $goodsGallery->goods_id = $goods->id;
                $goodsGallery->path = $v;
                $goodsGallery->save();
            }
            \Yii::$app->session->setFlash('success', '添加成功');
            return $this->redirect(['index']);
        }
    //查询分类数据
$goodsCate = GoodsCategory::find()->asArray()->all();
    //定义第一个显示的目录
$goodsCate[] = ['id' => 0, 'parent_id' => 0, 'name' => '请选择分类'];

    //转json字符串
$goodsCates = Json::encode($goodsCate);
//品牌一对多
$brand = Brand::find()->asArray()->all();
$brands = ArrayHelper::map($brand, 'id', 'name');

    //定义默认显示
$goods->status = 1;
$goods->is_on_sale = 1;
    //显示添加页面
return $this->render('add', ['model' => $goods, 'goodsCate' => $goodsCates, 'brands' => $brands, 'img' => $goodsGallery,'intro'=>$goodsIntro]);
}

//商品修改
    public function actionEdit($id)
    {
        $goods =Goods::findOne($id);
        $goodsGallery =GoodsGallery::find()->where(['goods_id'=>$goods->id])->all();
        $goodsIntro =GoodsIntro::findOne(['goods_id'=>$id]);
        $request = \Yii::$app->request;
        if ($request->isPost) {
            $data=$request->post();

            if ($goods->load($data) && $goods->validate()) {
                $goods->update();


//商品内容表操作保存数据


            $goodsIntro->goods_id = $goods->id;
            $goodsIntro->content=$data["GoodsIntro"]["content"];
            $goodsIntro->update();

//商品图片表操作
            foreach ($data['Goods']["imgPath"] as $v) {
                $goodsGallery = new GoodsGallery();
                $goodsGallery->goods_id = $goods->id;
                $goodsGallery->path = $v;
                $goodsGallery->update();
            }
            \Yii::$app->session->setFlash('success', '修改成功');
            return $this->redirect(['index']);
        }
        }
        //查询分类数据
        $goodsCate = GoodsCategory::find()->asArray()->all();
        //定义第一个显示的目录
        $goodsCate[] = ['id' => 0, 'parent_id' => 0, 'name' => '请选择分类'];

        //转json字符串
        $goodsCates = Json::encode($goodsCate);
//品牌一对多
        $brand = Brand::find()->asArray()->all();
        $brands = ArrayHelper::map($brand, 'id', 'name');

        //循环多图片
            if(!empty($goodsGallery)){
    foreach ($goodsGallery as $v){
        $goods->imgPath[]=$v->path;

    }
            }else{
                $goodsGallery=[];
            }
        //显示添加页面
        return $this->render('add', ['model' => $goods, 'goodsCate' => $goodsCates, 'brands' => $brands, 'img' => $goodsGallery,'intro'=>$goodsIntro]);
    }

//删除商品
public function actionDel($id){
        $goods = Goods::findOne($id);
        $intro = GoodsIntro::deleteAll(['goods_id'=>$goods->id]);
        $gallery =GoodsGallery::deleteAll(['goods_id'=>$goods->id]);
        $goods->delete();
        \Yii::$app->session->setFlash('success','删除成功');
        return $this->redirect(['index']);



}

}
