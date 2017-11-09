<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171107_033937_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull()->defaultValue("")->comment('商品名称'),
            'sn'=>$this->char(50)->comment('商品编号'),
            'logo'=>$this->string(150)->notNull()->defaultValue("")->comment('商品logo'),
            'goods_category_id'=>$this->integer()->comment('商品分类id'),
            'brand_id'=>$this->integer()->comment('品牌id'),
            'market_price'=>$this->decimal(10,2)->notNull()->defaultValue(0)->comment('市场价格'),
            'shop_price'=>$this->decimal(10,2)->notNull()->defaultValue(0)->comment('本店价格'),
            'stock'=>$this->integer()->comment('库存'),
            'is_on_sale'=>$this->smallInteger()->comment('是否上架'),
            'status'=>$this->smallInteger()->comment('状态'),
            'sort'=>$this->integer()->comment('排序'),
            'create_time'=>$this->integer()->comment('商品入库时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
