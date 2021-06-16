<?php
namespace DianJiang\Object\Order;

class Order
{

    // 文档地址 http://docs.shoplazza.com/#/openapi/2020-07/orders?id=%e8%ae%a2%e5%8d%95api

    /**
     * id
     * @var string|null
     */
    public $id = null;

    /**
     * 订单编号
     * @var string|null
     */
    public $number = null;

    /**
     * 订单备注
     * @var string|null
     */
    public $note = null;

    /**
     * 总价
     * @var float|null
     */
    public $total_price	= 0.0000;

    /**
     * 官方文档未说明次字段含义
     * @var float|null
     */
    public $sub_total = 0.0000;

    /**
     * 货币类型
     * @var string|null
     */
    public $currency = null;

    /**
     * 订单支付状态
     * @var string|null waiting(待支付)，paying(支付中)，paid(已支付)，cancelled(已取消)，failed(失败)，refunding(退款中)，refund_failed(退款失败)，refunded(已退款), partially_refunded(部分退款)
     */
    public $financial_status = null;

    /**
     * 订单状态
     * @var string|null opened(未完成)，placed(进行中)，finished(已完成)，cancelled(已取消)
     */
    public $status = null;

    /**
     * 订单取消时间
     * @var string|null
     */
    public $canceled_at = null;

    /**
     * 订单取消原因
     * @var string|null
     */
    public $cancel_reason = null;

    /**
     * 支付方式
     * @var string|null cod, online , none
     */
    public $payment_method = null;

    /**
     * 物流状态
     * @var  string|null initialled(空)，waiting(待发货)，partially_shipped(部分发货)，shipped(已发货)，partially_finished(部分完成)，finished(已完成), cancelled(取消)，returning(退货中)，returned(已退货)
     */
    public $fulfillment_status = null;

    /**
     * 客户删除订单时间
     * @var string|null
     */
    public $customer_deleted_at = null;

    /**
     * 订单删除时间
     * @var string|null
     */
    public $deleted_at = null;

    /**
     * 订单确认时间
     * @var string|null
     */
    public $placed_at = null;

    /**
     * 订单标签
     * @var string|null
     */
    public $tags = null;

    /**
     * 订单优惠码
     * @var string|null
     */
    public $discount_code = null;

    /**
     * 客户是否订阅订单通知
     * @var boolean
     */
    public $buyer_accepts_marketing	= null;

    /**
     * 订单优惠码优惠价格
     * @var float|null
     */
    public $code_discount_total	= 0.0000;

    /**
     * 商品折扣
     * @var float|null
     */
    public $line_item_discount_total = 0.0000;

    /**
     * 客户备注
     * @var string|null
     */
    public $customer_note = null;

    /**
     * 订单折扣
     * @var float|null
     */
    public $total_discount = 0.0000;

    /**
     * 总税费
     * @var float|null
     */
    public $total_tax = 0.0000;

    /**
     * 运费
     * @var float|null
     */
    public $total_shipping = 0.0000;

    /**
     * 创建时间
     * @var string|null
     */
    public $created_at = null;

    /**
     * 更新时间
     * @var string|null
     */
    public $updated_at = null;

    /**
     * 着陆页
     * @var string|null
     */
    public $landing_site = null;

    /**
     * 折扣申请
     * @var array|null
     */
    public $discount_applications = null;

    /**
     * ip
     * @var string|null
     */
    public $browser_ip = null;

    /**
     * 支付信息
     * @var \DianJiang\Object\Order\PaymentLine|null
     */
    public $payment_line = null;

    /**
     * 客户信息
     * @var \DianJiang\Object\Order\Customer|null
     */
    public $customer = null;


    /**
     * 收货地址
     * @var \DianJiang\Object\Order\ShippingAddress|null
     */
    public $shipping_address = null;

    /**
     * 账单地址
     * @var \DianJiang\Object\Order\ShippingAddress|null
     */
    public $billing_address = null;

    /**
     * 物流
     * @var \DianJiang\Object\Order\ShippingLine|null
     */
    public $shipping_line = null;

    /**
     * 订单商品数据
     * @var \DianJiang\Object\Order\LineItem[]|null
     */
    public $line_items = null;

    /**
     * 店匠返回未知字段
     * @var \DianJiang\Object\Order\Fulfillment[]|null
     */
    public $fulfillments = null;

}