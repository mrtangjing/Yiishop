<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_intro`.
 */
class m171107_035742_create_goods_intro_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_intro', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->comment('商品id'),
            'content'=>$this->text()->notNull()->defaultValue("")->comment('商品内容')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_intro');
    }
}
