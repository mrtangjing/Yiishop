<?php

namespace backend\controllers;

use backend\models\ArticleCategory;
use yii\web\Controller;

use yii;
class ArticleCategoryController extends Controller
{
    //文章分类显示
    public function actionIndex()
    {   $category =ArticleCategory::find()->all();


        return $this->render('index',['cate'=>$category]);
    }
    //添加分类
   public function actionAdd(){
       $cate = new ArticleCategory();
       $requset = \Yii::$app->request;
       if($requset->isPost){
           if ($cate->load($requset->post()) && $cate->validate()) {
               $cate->save();
               yii::$app->session->setFlash('success','添加成功');
               return $this->redirect(['index']);
           }
       }


       $cate->status=1;
       $cate->is_help=1;
       return $this->render('add',['cate'=>$cate]);
   }
   //编辑文章
    public function actionEdit($id){
        $cate = ArticleCategory::findOne($id);
        $requset = \Yii::$app->request;
        if($requset->isPost){
            if ($cate->load($requset->post()) && $cate->validate()) {
                $cate->save();
                yii::$app->session->setFlash('success','添加成功');
                return $this->redirect(['index']);
            }
        }
        return $this->render('add',['cate'=>$cate]);
    }
    //删除文章
    public function actionDel($id){
        $cate = ArticleCategory::findOne($id);
        $cate->delete();
        yii::$app->session->setFlash('success','删除文章成功');
        return $this->redirect(['index']);
    }
}
