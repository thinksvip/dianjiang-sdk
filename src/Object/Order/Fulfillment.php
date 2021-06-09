<?php


namespace DianJiang\Object\Order;


class Fulfillment
{
    /**
     * 运单id
     * @var string|null
     */
    public $id = null;

    /**
     * 订单id
     * @var string|null
     */
    public $order_id = null;

    /**
     * 运单状态
     * @var  string|null  waiting(待发货),shipped(已发货),finished(已完成),cancelled(已取消)
     */
    public $status = null;

    /**
     * 物流公司
     * @var string|null
     */
    public $tracking_company = null;

    /**
     * 运单号
     * @var string|null
     */
    public $tracking_number = null;

    /**
     * 物流公司编号
     * @var string|null
     */
    public $tracking_company_code = null;

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
     * 产品数据
     * @var array|null
     */
    public $line_items = null;
}