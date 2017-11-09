<?php

namespace backend\models;

use creocoder\nestedsets\NestedSetsBehavior;
use Yii;
use backend\components\Nested;
use flyok666\qiniu\Qiniu;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property integer $sort
 * @property integer $create_time
 */
class Goods extends \yii\db\ActiveRecord
{
    //定义状态
    public static $status = ['0' => '下架', '1' => '上架'];
    //定义是否显示
    public static $isSale = ['0' => '回收箱', '1' => '显示'];
    public $imgPath=[];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_category_id', 'brand_id','logo'],'safe'],
            [[ 'stock', 'is_on_sale', 'status', 'sort'], 'required'],
            [['market_price', 'shop_price'], 'number'],
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
            'name' => '商品名称',
            'sn' => '订单编号',
            'logo' => '商品logo',
            'goods_category_id' => '商品分类',
            'brand_id' => '商品品牌',
            'market_price' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '商品库存',
            'is_on_sale' => '是否上架',
            'status' => '商品状态',
            'sort' => '商品排序',
            'create_time' => '商品入库时间',
        ];
    }



    //获取商品分类信息一对一
    public function getGoodsCate()
    {
        return $this->hasOne(GoodsCategory::className(), ['id' => 'goods_category_id']);
    }

    //获取品牌分类信息一对一
    public function getBrand()
    {
        return Brand::findOne(['id' => $this->brand_id])->name;
    }

    //是否显示
    public function getSale()
    {
        return self::$isSale[$this->is_on_sale];
    }

    //状态
    public function getStatu()
    {
        return self::$status[$this->status];
    }


}
