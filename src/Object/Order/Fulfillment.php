<?php


namespace DianJiang\Object\Order;


class Fulfillment
{
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
}