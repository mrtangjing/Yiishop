<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\helpers\ArrayHelper;
use yii\rbac\Role;


class RoleController extends \yii\web\Controller
{
    //权限列表页
    public function actionIndex()
    {
        $authManager = \Yii::$app->authManager;
        //获取所有角色
        $roles = $authManager->getRoles();
        return $this->render('index', compact('roles'));

    }

    //角色添加
    public function actionAdd()
    {
        $authItem = new AuthItem();
        //实例化Rbac主键对象
        $authManager = \Yii::$app->authManager;
        //创建请求对象
        $requset = \Yii::$app->request;
        if ($requset->isPost) {

            if ($authItem->load($requset->post()) && $authItem->validate()) {
//                var_dump($requset->permissions);exit;
                //创建角色
                $role = $authManager->createRole($authItem->name);
//                var_dump($role);exit;
                //添加角色描述
                $role->description = $authItem->description;
//                var_dump( $role->description);exit;
//                添加角色
//                var_dump($authManager->add($role));exit;
                if ($authManager->add($role)) {
//                   echo 111;exit;
                    //给用户添加权限
//                    var_dump($authItem->permissions);exit;
//                    permissions
                    if ($authItem->permissions) {
//                        var_dump($role);exit;
//
                        //循环添加权限
                        foreach ($authItem->permissions as $permission) {
                            //分别把权限名称添加到对应的角色中
                            $authManager->addChild($role, $authManager->getPermission($permission));
                        }
                    }
                }
                //添加成功提示
                \Yii::$app->session->setFlash('success', '添加' . $authItem->name . '角色成功');
                return $this->redirect(['index']);
            } else {
                $authItem->getErrors();
                die();
            }
        }
        //显示权限
        $permissions = $authManager->getPermissions();
        $permissions = ArrayHelper::map($permissions, 'name', 'description');


        return $this->render('add', compact('authItem', 'permissions'));
    }

    // 修改角色
    public function actionEdit($name)
    {
        //实例化Rbac主键对象
        $authManager = \Yii::$app->authManager;
        $authItem = AuthItem::findOne($name);
        //通过角色得到角色的所有权限
        $rolePermission = $authManager->getPermissionsByRole($name);
        //取数组所有键
        $authItem->permissions = array_keys($rolePermission);
        //创建请求对象
        $requset = \Yii::$app->request;
        if ($requset->isPost) {
            if ($authItem->load($requset->post()) && $authItem->validate()) {

                //创建角色
                $role = $authManager->getRole($authItem->name);
                //修改角色描述
                $role->description = $authItem->description;
                //添加角色
                if ($authManager->update($authItem->name, $role)) {
                    //判断角色是否赋予权限
                    if ($authItem->permissions) {
                        //循环添加权限
                        foreach ($authItem->permissions as $permission) {
                            //分别把权限名称添加到对应的角色中
                            $authManager->addChild($role, $authManager->getPermission($permission));
                        }
                    }
                }
                //修改成功提示
                \Yii::$app->session->setFlash('success', '修改' . $authItem->name . '角色成功');
                return $this->redirect(['index']);
            }

        }
        //显示权限
        $permissions = $authManager->getPermissions();
        $permissions = ArrayHelper::map($permissions, 'name', 'description');

        return $this->render('add', compact('authItem', 'permissions'));

    }

//删除角色
    public function actionDel($name)
    {
        $auth = \Yii::$app->authManager;
        //找到要删除的角色对象
        $role = $auth->getRole($name);
        //删除当前角色所有权限
        $auth->removeChildren($role);
        //删除角色
        if ($auth->remove($role)) {
            \Yii::$app->session->setFlash("success", "删除" . $name . "成功");
            return $this->redirect(["index"]);


        }
    }
}