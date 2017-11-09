<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promotion`.
 */
class m171107_061555_create_promotion_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('promotion', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(100)->notNull()->defaultValue(""),
            'start_time'=>$this->integer()->comment('活动开始时间'),
            'end_time'=>$this->integer()->comment('活动结束时间')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('promotion');
    }
}
