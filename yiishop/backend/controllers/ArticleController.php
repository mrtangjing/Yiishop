<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii;

class ArticleController extends \yii\web\Controller
{
    //显示文章列表
    public function actionIndex()
    {
        $article = Article::find()->all();

        return $this->render('index', ['artic' => $article]);
    }

    public function actionAdd()
    {
        $artic = new Article();
        $content = new ArticleDetail();
        $requset = yii::$app->request;
        if ($requset->isPost) {
            if ($artic->load($requset->post()) && $artic->validate()) {
                //添加文章创建时间
//                $artic->inputtime = time();
                $artic->save();
                //绑定内容表数据及验证
                if ($content->load($requset->post()) && $content->validate()) {
                    //把文章标id赋值给内容表
                    $content->article_id = $artic->id;
                    $content->save();
                    yii::$app->session->setFlash('success', '添加文章成功');
                    return $this->redirect(['index']);
                }
            }
        }
       $category= yii\helpers\ArrayHelper::map(ArticleCategory::find()->all(),'id','name');

        $artic->status = 1;
        return $this->render('add', ['artic' => $artic, 'detail' => $content,'cate'=>$category]);

    }

    //编辑文章
    public function actionEdit($id)
    {
        //查询文章表数据
        $article = Article::findOne($id);
//根据文章id查询detail内容
        $detail =ArticleDetail::findOne(['article_id'=>$article->id]);
            $requset =yii::$app->request;
        //接收数据绑定
        if ($article->load($requset->post()) && $article->validate()) {
            //添加文章创建时间
//            $article->inputtime = time();
            $article->save();
            //绑定内容表数据及验证
            if ($detail->load($requset->post()) && $detail->validate()) {
                //把文章标id赋值给内容表
                $detail->article_id = $article->id;
                $detail->save();
                yii::$app->session->setFlash('success', '修改文章成功');
                return $this->redirect(['index']);
            }
        }
        //输出到dropDownList
        $category= yii\helpers\ArrayHelper::map(ArticleCategory::find()->all(),'id','name');
        return $this->render('add',['artic' => $article, 'detail' => $detail,'cate'=>$category]);

    }
    //删除文章
    public function actionDel($id){

        //查询文章表数据
        $article = Article::findOne($id);
//根据文章id查询detail内容
        $detail =ArticleDetail::findOne(['article_id'=>$article->id]);
        if ($article->delete() && $detail->delete()) {
            yii::$app->session->setFlash('success','删除文章成功');
            return $this->redirect(['index']);
        }
    }
    //查看文章内容
    public function actionShow($id){
            $detail = ArticleDetail::findOne(['article_id'=>$id]);
//            var_dump($detail->content);die();
            return $this->render('show',['detail'=>$detail]);
    }
}
