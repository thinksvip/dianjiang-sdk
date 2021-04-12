<?php


namespace DianJiang\Object\Order;

class LineItem
{

    /**
     * 商品标题
     * @var string|null
     */
    public $product_title = null;

    /**
     * 子商品标题
     * @var string|null
     */
    public $variant_title = null;

    /**
     * 商品数量
     * @var string|null
     */
    public $quantity = null;

    /**
     * 备注
     * @var string|null
     */
    public $note = null;

    /**
     * 商品图片
     * @var array|null
     */
    public $image = null;

    /**
     * 商品售价
     * @var float
     */
    public $price = 0;

    /**
     * 商品原价
     * @var float
     */
    public $compare_at_price = 0;

    /**
     * 总价
     * @var float
     */
    public $total = 0;

    /**
     * sku
     * @var string|null
     */
    public $sku = null;

    /**
     * 重量
     * @var float
     */
    public $weight = 0;

    /**
     * 重量单位
     * @var string|null
     */
    public $weight_unit = null;

    /**
     * 商品供应商
     * @var string|null
     */
    public $vendor = null;
    /**
     * 商品属性
     * @var array|null
     */
    public $properties = null;

    /**
     * 商品url
     * @var string|null
     */
    public $product_url = null;

    /**
     * 商品handle
     * @var string|null
     */
    public $product_handle = null;
}