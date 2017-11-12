<?php

namespace backend\controllers;

use backend\models\Admin;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;


class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $admin = Admin::find()->all();


        return $this->render('index', compact('admin'));
    }

    //用户注册
    public function actionAdd()
    {
        //创建模型对象
        $admin = new Admin();
        //创建角色对象
        $authManager = \Yii::$app->authManager;
        //创建接收数据对象
        $requset = \Yii::$app->request;
        if ($requset->isPost) {
            //接收数据
            $data = $requset->post();
            //绑定数据
            $admin->load($data);
            //对密码进行hash 加盐加密
            $admin->password = \Yii::$app->security->generatePasswordHash($admin->password);
            //创建用户的时间
            $admin->add_time = time();
            $admin->save();
            //处理角色
            if($data["Admin"]['roles']){

                foreach ($data["Admin"]['roles'] as $v){
                    //获取角色
                $role = $authManager->getRole($v);
                    //保存角色
                    $authManager->assign($role,$admin->id);
                }
            }
            //提示信息
            \Yii::$app->session->setFlash('siccess', '添加' . $admin->username . '成功');
            return $this->redirect(['login']);
        }
        //获取所有角色
        $roles = $authManager->getRoles();
            //调用ArrayHelper方法用于dropDownList
       $roles= ArrayHelper::map($roles,'name','description');

        return $this->render('add', compact('admin','roles'));

    }

//编辑用户
    public function actionEdit($id)
    {
        //创建模型对象
        $admin = Admin::findOne($id);
        //创建接收数据对象
        $requset = \Yii::$app->request;
        if ($requset->isPost) {
            //接收数据
            $data = $requset->post();
            //绑定数据
            $admin->load($data);
            //对密码进行hash 加盐加密
            $admin->password = \Yii::$app->security->generatePasswordHash($admin->password);
            //创建用户的时间
            $admin->add_time = time();
            $admin->save();
            \Yii::$app->session->setFlash('siccess', '修改' . $admin->username . '成功');
            return $this->redirect(['index']);
        }

        $admin->password="";
        return $this->render('add', compact('admin'));

    }
    /**
     * @return 删除用户信息
     */
    public function actionDel($id)
    {
        if(Admin::findOne($id)->delete()){
            \Yii::$app->session->setFlash('success','删除成功');
            return $this->redirect(['index']);
        }

    }
    //用户登录
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $admin = new Admin();
        $requset = \Yii::$app->request;
        if ($requset->isPost) {
            $data = $requset->post();
            //绑定数据和验证数据
            if ($admin->load($data) && $admin->validate()) {
                //根据用户名查询用户信息
                $adminModel = Admin::findOne(['username' => $admin->username]);

                if ($adminModel) {
                    //验证密码
                    if (\Yii::$app->security->validatePassword($admin->password, $adminModel->password)) {
                        //随机字符串auth_key
                        $adminModel->auth_key = \Yii::$app->security->generateRandomString();
                        //保存最后登录时间
                        $adminModel->last_login_time = time();
                        //保存最后登录ip
                        $adminModel->last_login_ip = $requset->getUserIP();
                        $adminModel->save();
                        //登录和保存登录session
                        \Yii::$app->user->login($adminModel, $admin->rememberMe ? 3600 * 24 * 7 : 0);
                        //提示登录信息
                        \Yii::$app->session->setFlash('success', '登录成功');
                        //跳转页面
                        return $this->redirect(['index']);
                    } else {
                        //用户密码错误
                        $admin->addError('danger', '用户密码错误');
                    }
                } else {
                    //用户名不存在
                    $adminModel->addError('danger', $admin->username . '不存在');
                }
            } else {
                //调试用的打印错误信息
                var_dump($admin->getErrors());
                die();
            }
        }
        return $this->render('login', ['login' => $admin]);

    }
    //退出登录
    public function actionLogOut(){
        //调用User主键退出登录
        \Yii::$app->user->logout();
        //跳转首页
        return $this->redirect(['index']);



    }

}
