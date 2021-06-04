<?php


namespace DianJiang\Object\Order;


class Customer
{

    /**
     * 客户邮箱
     * @var string|null
     */
    public $email = null;

    /**
     * 名
     * @var string|null
     */
    public $first_name = null;

    /**
     * 姓
     * @var string|null
     */
    public $last_name = null;

    /**
     * 客户下单数
     * @var float|null
     */
    public $orders_count = 0;

    /**
     * 顾客消费总额
     * @var float|null
     */
    public $total_spent = 0;

    /**
     * 客户手机号码
     * @var string|null
     */
    public $phone = null;
}