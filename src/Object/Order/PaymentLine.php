<?php


namespace DianJiang\Object\Order;


class PaymentLine
{

    /**
     * 支付渠道
     * @var string|null
     */
    public $payment_channel	= null;

    /**
     * 支付方式
     * @var string|null
     */
    public $payment_method = null;

    /**
     * 交易号
     * @var string|null
     */
    public $transaction_no = null;

    /**
     * 收款账户ID
     * @var string|null
     */
    public $merchant_id = null;

    /**
     * 收款账户Email
     * @var string|null
     */
    public $merchant_email = null;

}