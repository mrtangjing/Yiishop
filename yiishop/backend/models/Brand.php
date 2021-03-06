<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3
 * Time: 18:49
 */

namespace backend\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Brand extends ActiveRecord
{
    //定义图片上传属性
//    public $imageFile;
    public static $status = ['0' => '隐藏', '1' => '显示'];

    //验证数据
    public function rules()
    {

        return [
            [['name', 'intor', 'srot', 'status'], 'required'],
            [['srot', 'status'], 'integer'],
            [['logo'], 'safe']

        ];
    }

    //语言
    public function attributeLabels()
    {
        return [
            'name' => '品牌名称',
            'intor' => '品牌简介',
            'logo' => 'logo',
            'srot' => '品牌排序',
            'status' => '品牌状态'
        ];
    }

    //行为自动设置时间
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time'],
//                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ]
        ];
    }
    //判断本地图片和七牛云图片
    public function getImages(){

        if(substr($this->logo,0,7)=='http://'){
            return $this->logo;
        }else{
            return '/'.$this->logo;
        }


    }
}