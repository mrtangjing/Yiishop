<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m171105_064201_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull()->defaultValue("")->comment('商品分类名称'),
            'parent_id'=>$this->integer()->comment('分类父id'),
            'lft'=>$this->smallInteger(10)->comment('左值'),
            'rght'=>$this->smallInteger(10)->comment('右值'),
            'tree'=>$this->smallInteger(10)->comment('树类型'),
            'depth'=>$this->smallInteger(10)->comment('深度')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}
