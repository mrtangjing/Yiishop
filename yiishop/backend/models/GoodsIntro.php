<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 11:57
 */

namespace backend\models;


use yii\db\ActiveRecord;

class GoodsIntro extends ActiveRecord
{
    public function rules()
    {
        return[
            [['content'],'required']
        ] ;
    }
    public function attributeLabels()
    {
        return[
            'content'=>'商品内容'
        ];
    }

}