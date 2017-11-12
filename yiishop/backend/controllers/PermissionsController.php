<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionsController extends \yii\web\Controller
{
    //权限列表
    public function actionIndex()
    {
        $authItem = AuthItem::find()->all();
        return $this->render('index',compact('authItem'));
    }

    //权限添加
    public function actionAdd()
    {
        $authItem = new AuthItem();

        //创建一个请求对象
        $requset = \Yii::$app->request;
        if ($authItem->load($requset->post()) && $authItem->validate()) {
            //创建rbac权限对象
            $authManager = \Yii::$app->authManager;
            //创建权限
            $permission = $authManager->createPermission($authItem->name);
            //处理描述
            $permission->description = $authItem->description;
            //添加权限
            $authManager->add($permission);
            //提示添加信息
            \Yii::$app->session->setFlash('success', '添加' . $authItem->name . '权限成功');
            //刷新页面
//            return $this->refresh();
            //跳转页面
            return $this->redirect(['index']);
        }
        //显示添加页面
        return $this->render('add', compact('authItem'));

    }

//修改权限
    public function actionEdit($name)
    {
        $authItem =  AuthItem::findOne($name);

        //创建一个请求对象
        $requset = \Yii::$app->request;
        if ($authItem->load($requset->post()) && $authItem->validate()) {
            //创建rbac权限对象
            $authManager = \Yii::$app->authManager;
//            var_dump($authItem->name);exit();
            //获取权限
            $permission =$authManager->getPermission($authItem->name);
//                var_dump($permission);die();
            if ($permission) {
                //修改描述
                $permission->description = $authItem->description;
                //修改权限
                $authManager->update($authItem->name,$permission);
                //提示添加信息
                \Yii::$app->session->setFlash('success', '修改' . $authItem->name . '权限成功');
                //刷新页面
//                return $this->refresh();
                //跳转页面
                return $this->redirect(['index']);
            }else{
               die(1213);
            }

        }else{
            \Yii::$app->session->setFlash("danger","不能修改权限名称".$authItem->name);
            //刷新页面
            return $this->refresh();
        }
        //显示添加页面
        return $this->render('add', compact('authItem'));

    }
    //删除权限
    public function actionDel($name){
        $authManager = \Yii::$app->authManager;
        //找到要删除的权限对象
        $pemission = $authManager->getPermission($name);
        //删除权限
        if ($authManager->remove($pemission)) {
            \Yii::$app->session->setFlash('success','删除'.$name.'权限成功');
            return $this->redirect(['index']);
        }



    }
}
