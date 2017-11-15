<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

class GoodsCategoryController extends \yii\web\Controller
{
    //商品分类显示列表
    public function actionIndex()
    {
        $goodsCate = GoodsCategory::find();
        $data = new ActiveDataProvider([
            'query' => $goodsCate,
            'pagination' => false
        ]);
//            var_dump($data);die();
        return $this->render('index',['category'=>$data]);
    }
    //添加分类
    public function actionAdd(){
        //创建模型对象
        $cateModel =new GoodsCategory();
        //创建接收数据对象
            $requset = Yii::$app->request;
            //判断接收数据方式
        if ($requset->isPost) {
//                var_dump($requset->post());die();
            //数据绑定及数据验证
            if ($cateModel->load($requset->post()) && $cateModel->validate()) {
                //判断接收数据的parent_id==0
                if ($cateModel->parent_id==0) {
                    //数据保存根目录下
                    $cateModel->makeRoot();
                }else{
                    //先根据pid查询数据
                    $cate = GoodsCategory::findOne(['id'=>$cateModel->parent_id]);
                    //判断增加到三级目录
                    if($cate->depth > 1){
                        Yii::$app->session->setFlash('danger','此目录不能再添加子目录');
                        //刷新页面
                        return $this->refresh();
                    }else{
                        //数据保存在对应的父id下
                        $cateModel->prependTo($cate);
                    }
                    //添加成功后提示信息
                    Yii::$app->session->setFlash('success','添加成功');
                    //添加成功后跳转首页面
                    return $this->redirect(['index']);
                }
            }
        }
        //查询分类数据
        $cates = GoodsCategory::find()->asArray()->all();
        //定义第一个显示的目录
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        //转json字符串
       $goods =Json::encode($cates);
            //显示添加页面
        return $this->render('add',['model'=>$cateModel,'cates'=>$goods]);
    }
    //编辑分类
    public function actionEdit($id){

        //创建模型对象
        $cateModel = GoodsCategory::findOne($id);
        //创建接收数据对象
        $requset = Yii::$app->request;
        //判断接收数据方式
        if ($requset->isPost) {
//                var_dump($requset->post());die();
            //数据绑定及数据验证
            if ($cateModel->load($requset->post()) && $cateModel->validate()) {
                        $cateModel->save();
                    //添加成功后提示信息
                    Yii::$app->session->setFlash('success','添加成功');
                    //添加成功后跳转首页面
                    return $this->redirect(['index']);
                }
        }
        //查询分类数据
        $cates = GoodsCategory::find()->asArray()->all();
        //定义第一个显示的目录
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        //转json字符串
        $goods =Json::encode($cates);
        //显示添加页面
        return $this->render('add',['model'=>$cateModel,'cates'=>$goods]);

    }
    //删除分类
    public function actionDel($id)
    {
       $cate = GoodsCategory::find()->where(['parent_id'=>$id])->all();
       $model = GoodsCategory::findOne($id);
        if ($cate) {
            Yii::$app->session->setFlash('success','该目录下有子目录不能被删除');
            return $this->redirect(['index']);

        }else{
            if($model->parent_id == 0 ){

                Yii::$app->session->setFlash('succes','不能删除根目录');

            }else{

                $model->delete();

                Yii::$app->session->setFlash('success','删除成功');

            }
            return $this->redirect(['index']);

        }

    }
}
