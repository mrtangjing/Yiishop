<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 0:59
 */

namespace backend\models;


use yii\base\Model;

class GoodsSearchForm extends Model
{

    public $keyword;
    public $minPrice;
    public $maxPrice;
    public function rules()
    {
        return [
            [['minPrice','maxPrice'],'number'],
            ['keyword','safe']
        ];
    }
}