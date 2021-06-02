<?php
namespace DianJiang\API;



class Response
{


    /**
     * Server time when response was sent.
     * @var Request
     */
    public $request = null;
    /**
     * Status of the request.
     * @var int
     */
    public $status = ResponseStatus::PENDING;


    /**
     * Contains information about any error that might have occurred.
     * @var null
     */
    public $error = null;

    /**
     * 订单列表
     * @var \DianJiang\Object\Order\Order[]
     */
    public $orders = null;

    /**
     * 订单详情
     * @var \DianJiang\Object\Order\Order
     */
    public $order;

    /**
     * 运单列表
     * @var \DianJiang\Object\Order\Fulfillment[]
     */
    public $fulfillments;

    /**
     * 运单详情
     * @var \DianJiang\Object\Order\Fulfillment
     */
    public $fulfillment;

    function __construct(Request $request)
    {
        $this->request = $request;
    }
}