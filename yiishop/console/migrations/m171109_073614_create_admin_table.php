<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171109_073614_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(100)->notNull()->defaultValue("")->comment('用户名'),
            'password'=>$this->string(64)->notNull()->defaultValue("")->comment('密码'),
            'email'=>$this->string(50)->notNull()->defaultValue("")->comment('邮箱'),
            'auth_key'=>$this->string(60)->notNull()->defaultValue("")->comment('令牌'),
            'auth_kye_time'=> $this->integer()->comment('令牌创建时间'),
            'add_time'=>$this->integer()->comment('注册时间'),
            'last_login_time'=>$this->integer()->comment('最后登录时间'),
            'last_login_ip'=>$this->string(15)->comment('最后登录IP')

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
