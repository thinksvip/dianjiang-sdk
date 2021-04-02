<?php
namespace DianJiang\API;



class Response
{
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
     * @var \DianJiang\Object\Order\Order[]|null
     */
    public $orders = null;

    /**
     * 订单详情
     * @var \DianJiang\Object\Order\Order[]|null
     */
    public $order = null;

    function __construct(Request $request)
    {
        $this->request = $request;
    }
}