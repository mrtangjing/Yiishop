<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $is_help
 */
class ArticleCategory extends ActiveRecord
{
    public static $status=['0'=>'下架','1'=>'上架'];
    public static  $is_help=['0'=>'否','1'=>'是'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','name', 'sort', 'is_help'], 'required'],
            [['name', 'intro'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '文章分类名称',
            'intro' => '分类简介',
            'status' => '分类文章状态',
            'sort' => '分类排序',
            'is_help' => '是否是帮助相关分类',
        ];
    }
}
