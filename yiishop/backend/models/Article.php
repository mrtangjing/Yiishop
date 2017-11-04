<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $article_category_id
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Article extends \yii\db\ActiveRecord
{
    public static $status=['0'=>'下架','1'=>'下架'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_category_id','name', 'status', 'sort'], 'required'],
            [['name', 'intro'], 'string', 'max' => 255],
//            [['inputtime'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'name' => '文章名称',
            'article_category_id' => '分类',
            'intro' => '文章简介',
            'status' => '文章状态',
            'sort' => '排序',
            'inputtime' => '文章录入时间',
        ];
    }
    //行为自动设置时间
    public function behaviors()
    {
        return [
            [
                'class' =>TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['inputtime'],
//                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ]
        ];
    }
    //一对一
    public function getCategory()
    {
        return ArticleCategory::findOne($this->article_category_id)->name;
    }
    //一对多没用
//    public function getCate(){
//        return $this->hasMany(ArticleCategory::className(),['id'=>$this->id]);
//    }
}
