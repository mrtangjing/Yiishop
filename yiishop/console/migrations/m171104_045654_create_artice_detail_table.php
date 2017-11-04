<?php

use yii\db\Migration;

/**
 * Handles the creation of table `artice_detail`.
 */
class m171104_045654_create_artice_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('artice_detail', [
            'id' => $this->primaryKey(),
            'article_id'=>$this->integer()->comment('联表的文章id'),
            'content'=>$this->text()->defaultValue("")->comment('文章内容')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('artice_detail');
    }
}
