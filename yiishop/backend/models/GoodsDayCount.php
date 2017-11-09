<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 1:43
 */

namespace backend\models;


use yii\db\ActiveRecord;

class GoodsDayCount extends ActiveRecord
{
    public function rules()
    {
        return [
            [['day','count'],'safe']
        ] ;
    }

}