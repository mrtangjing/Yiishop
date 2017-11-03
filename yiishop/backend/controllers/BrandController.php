<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3
 * Time: 15:54
 */

namespace backend\controllers;



use backend\models\Brand;
use yii\web\Controller;
use yii;
use yii\web\UploadedFile;
class BrandController extends Controller
{
    //显示品牌
    public function actionIndex(){
            //分页
        //查出总条数
        $count = Brand::find()->where(['!=','status','-1'])->count();
        //定义每页显示的条数
        $pageSize = 2;
        //调用分页类
        $page = new  yii\data\Pagination([
            'pageSize'=> $pageSize,
            'totalCount'=>$count
        ]);
       $brands = Brand::find()->where(['!=','status','-1'])->limit($page->limit)->offset($page->offset)->all();
       //显示视图
        return $this->render('index',['brands'=>$brands,'page'=>$page]);
    }
    //添加品牌
    public function actionAdd(){
        $brand = new Brand();
        //创建请求对象
        $requset =yii::$app->request;
        if ($brand->load($requset->post())) {
            //创建图片上传对象
            $brand->imageFile=UploadedFile::getInstance($brand,'imageFile');
            //拼接图片路径
            $imagePuth='images/'.time().mt_rand(100,999).'.'.$brand->imageFile->extension;
                if($brand->validate()){
                    //图片上传
                    $brand->imageFile->saveAs($imagePuth,false);
                    //图片路径保存数据库
                    $brand->logo=$imagePuth;
                    //保存数据
                    $brand->save();
                    //提示信息
                    yii::$app->session->setFlash('session','品牌添加成功');
                    //条状页面
                    return $this->redirect(['brand/index']);
                }


        }

        $brand->status=1;
        //显示添加视图
        return $this->render('add',['brand'=>$brand]);
    }
    //编辑品牌
    public function actionEdit($id){
        $brand = Brand::findOne($id);
//        var_dump($brand);die();
        //创建请求对象
        $requset =yii::$app->request;
        if ($requset->isPost) {
            if ($brand->load($requset->post())) {
                //创建图片上传对象
                $brand->imageFile=UploadedFile::getInstance($brand,'imageFile');
                //拼接图片路径
                $imagePuth='images/'.time().mt_rand(100,999).'.'.$brand->imageFile->extension;
                if($brand->validate()){
                    //图片上传
                    $brand->imageFile->saveAs($imagePuth,false);
                    //图片路径保存数据库
                    $brand->logo=$imagePuth;
                    //保存数据
                    $brand->save();
                    //提示信息
                    yii::$app->session->setFlash('session','品牌添加成功');
                    //条状页面
                    return $this->redirect(['brand/index']);
                }


            }

        }


        //显示修改视图
        return $this->render('add',['brand'=>$brand]);
    }
//删除品牌
public function actionDel($id){

        $brand = Brand::findOne($id);

        $brand->status= -1;

        $brand->save(false);
        return $this->redirect('index');
}
//回收箱
public function actionRemov(){
    $count = Brand::find()->where(['status'=>-1])->count();
    //定义每页显示的条数
    $pageSize = 2;
    //调用分页类
    $page = new  yii\data\Pagination([
        'pageSize'=> $pageSize,
        'totalCount'=>$count
    ]);
    $brands = Brand::find()->where(['status'=>-1])->limit($page->limit)->offset($page->offset)->all();

    //显示回收箱
    return $this->render('remov',['brands'=>$brands,'page'=>$page]);
}
}