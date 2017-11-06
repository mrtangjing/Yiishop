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
use flyok666\qiniu\Qiniu;

class BrandController extends Controller
{
    //显示品牌
    public function actionIndex()
    {
        //分页
        //查出总条数
        $count = Brand::find()->where(['!=', 'status', '-1'])->count();
        //定义每页显示的条数
        $pageSize = 4;
        //调用分页类
        $page = new  yii\data\Pagination([
            'pageSize' => $pageSize,
            'totalCount' => $count
        ]);
        $brands = Brand::find()->where(['!=', 'status', '-1'])->limit($page->limit)->offset($page->offset)->all();
        //显示视图
        return $this->render('index', ['brands' => $brands, 'page' => $page]);
    }

    //添加品牌
    public function actionAdd()
    {
        $brand = new Brand();
        //创建请求对象
        $requset = yii::$app->request;
        if ($brand->load($requset->post())) {
//            var_dump($requset);die();
//图片上传本地
            //创建图片上传对象
//            $brand->imageFile = UploadedFile::getInstance($brand, 'imageFile');
            //拼接图片路径
//            $imagePuth = 'images/' . time() . mt_rand(100, 999) . '.' . $brand->imageFile->extension;
//            if ($brand->validate()) {
            //图片上传
//                $brand->imageFile->saveAs($imagePuth, false);
            //图片路径保存数据库
//                $brand->logo = $imagePuth;
//图片上传七牛云
//            var_dump($_FILES['Brand']['tmp_name']);die();
            //保存数据
            $brand->save();
            //提示信息
            yii::$app->session->setFlash('session', '品牌添加成功');
            //条状页面
            return $this->redirect(['brand/index']);
    }


        $brand->status = 1;
        //显示添加视图
        return $this->render('add', ['brand' => $brand]);
    }

    //编辑品牌
    public function actionEdit($id)
    {
        $brand =Brand::findOne($id);
        //创建请求对象
        $requset = yii::$app->request;
        if ($brand->load($requset->post())) {
//图片上传本地
            //创建图片上传对象
//            $brand->imageFile = UploadedFile::getInstance($brand, 'imageFile');
            //拼接图片路径
//            $imagePuth = 'images/' . time() . mt_rand(100, 999) . '.' . $brand->imageFile->extension;
//            if ($brand->validate()) {
            //图片上传
//                $brand->imageFile->saveAs($imagePuth, false);
            //图片路径保存数据库
//                $brand->logo = $imagePuth;
            //保存数据
            $brand->save();
            //提示信息
            yii::$app->session->setFlash('session', '品牌修改成功');
            //条状页面
            return $this->redirect(['brand/index']);
        }


        $brand->status = 1;
        //显示添加视图
        return $this->render('add', ['brand' => $brand]);
    }

//删除品牌
    public function actionDel($id)
    {

        $brand = Brand::findOne($id);

        $brand->status = -1;

        $brand->save(false);
        return $this->redirect('index');
    }

//回收箱
    public function actionRemov()
    {
        $count = Brand::find()->where(['status' => -1])->count();
        //定义每页显示的条数
        $pageSize = 2;
        //调用分页类
        $page = new  yii\data\Pagination([
            'pageSize' => $pageSize,
            'totalCount' => $count
        ]);
        $brands = Brand::find()->where(['status' => -1])->limit($page->limit)->offset($page->offset)->all();

        //显示回收箱
        return $this->render('remov', ['brands' => $brands, 'page' => $page]);
    }

    public function actionUpload()
    {
        //七牛云上传图片
        $config = [
            'accessKey' => 'nr0J_R5F7uBc52ud-BbPV055TF_bcvpPTH4zyTWV',//ak
            'secretKey' => '4kgoBSM9JUeaD2RkTFsgxQytH_ngSmcuSAZf4qKR',//sk
            'domain' => 'http://oyvp0dnjb.bkt.clouddn.com',//七牛云临时域名---
            'bucket' => 'yiishop',//七牛云保存图片库的名称-----区分大小写
            'area' => Qiniu::AREA_HUADONG //华东地区
        ];
//        var_dump($_FILES['file']['tmp_name']);die();
        //创建七牛云对象
        $qiniu = new Qiniu($config);
        $key = time();
       // var_dump($_FILES['file']['tmp_name']);exit;
        //文件上传七牛云
        $qiniu->uploadFile($_FILES['file']['tmp_name'], $key);
       // var_dump($qiniu);exit;
        //获取七牛云图片保存地址
        $url = $qiniu->getLink($key);
        //拼装图片路径
        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];
        //将拼装的路径传到页面显示
        echo json_encode($info);
        //前端需要的数据格式
        //        {"code": 0, "url": "http://domain/图片地址", "attachment": "图片地址"}
    }

}