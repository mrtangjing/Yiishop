<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/8
 * Time: 0:23
 */

namespace backend\models;


use yii\db\ActiveRecord;

class GoodsGallery extends ActiveRecord {

    public function rules()
    {
        return [
            [['path'],'required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'path'=>'商品图片'
        ];
    }
}