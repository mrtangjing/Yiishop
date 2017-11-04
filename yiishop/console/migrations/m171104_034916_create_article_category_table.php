<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m171104_034916_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->defaultValue("")->comment('文章分类名称'),
            'intro'=>$this->string()->comment('分类简介'),
            'status'=>$this->integer(4)->defaultValue(0)->comment('分类文章状态'),
            'sort'=>$this->integer(100)->defaultValue(0)->comment('分类排序'),
            'is_help'=>$this->integer(4)->defaultValue(0)->comment('是否是帮助相关分类')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
