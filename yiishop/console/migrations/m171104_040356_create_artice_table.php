<?php

use yii\db\Migration;

/**
 * Handles the creation of table `artice`.
 */
class m171104_040356_create_artice_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('artice', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->defaultValue("")->comment('文章名称'),
            'article_category_id'=>$this->integer()->comment('分类id'),
            'intro'=>$this->string()->defaultValue("")->comment('文章简介'),
            'status'=>$this->integer(4)->comment('文章状态'),
            'sort'=>$this->integer(100)->comment('排序'),
            'inputtime'=>$this->integer()->comment('文章录入时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('artice');
    }
}
