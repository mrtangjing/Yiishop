<?php

namespace backend\models;


use backend\components\Nested;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $lft
 * @property integer $rght
 * @property integer $tree
 * @property integer $depth
 */
class GoodsCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','intro'],'required'],
            [['parent_id'], 'safe'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'parent_id' => '分类目录',
            'lft' => '左值',
            'rght' => '右值',
            'tree' => '树类型',
            'depth' => '深度',
            'intro'=>'分类简介'
        ];
    }

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                 'leftAttribute' => 'lft',
                 'rightAttribute' => 'rght',
                 'depthAttribute' => 'depth',

            ],
        ];
    }



    public  function  transactions()
    {
        return [
            self :: SCENARIO_DEFAULT => self :: OP_ALL,
        ];
    }

    public  static  function  find()
    {

        return new Nested(get_called_class());

    }
}
