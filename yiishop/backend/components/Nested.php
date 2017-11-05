<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/5
 * Time: 15:04
 */
namespace backend\components;
use \creocoder\nestedsets\NestedSetsQueryBehavior;
use \yii\db\ActiveQuery;

class Nested extends ActiveQuery
{
    //插件Nested分类
    public function behaviors()
    {
        return [
            NestedSetsQueryBehavior::className()
            ];

    }
}