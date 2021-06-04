<?php

namespace DianJiang\Object;

class Webhook
{
    /*
     * Webhook
     * http://docs.shoplazza.com/#/openapi/2020-07/webhooks?id=webhook
     */ 
    
    /**
     * Webhook id
     * @var string|null
     */
    public $id = null;

    /**
     *  回调地址
     * @var string|null
     */
    public $address = null;

    /**
     * 监听事件
     * @var string|null
     */
    public $topic = null;

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
     * 返回类型
     * @var string|null
     */
    public $format = null;

}