<?php


namespace DianJiang\API;


class Webhook extends Request
{
    //@var string 请求类型
    public $requestType = null;

    /**
     * 创建Webhook
     * @param string $address Webhook通知URL
     * @param string $topic 订阅事件名称
     * @return Webhook
     */
    public static function CreateWebhook(string $address, string $topic)
    {
        $webhook = new Webhook();

        $webhook->bodyData['address'] = $address;

        $webhook->bodyData['topic'] = $topic;

        $webhook->path = "webhooks";

        $webhook->requestType = 'POST';

        return $webhook;
    }

    /**
     * 获取Webhook列表
     * @param string $address Webhook通知URL
     * @param string $topic 订阅事件名称
     * @param int $limit 指定每分页返回Webhook结果的数量，预设值为50，最大值为250
     * @param int $page 分页
     * @param array|null $params 附加请求条件
     * @return Webhook
     */
    public static function SelectWebhookIndex(string $address, string $topic, int $limit = 250, int $page = 1, array $params = null)
    {
        $webhook = new Webhook();

        $webhook->parameter['address'] = $address;

        $webhook->parameter['topic'] = $topic;

        $webhook->parameter['limit'] = $limit;

        $webhook->parameter['page'] = $page;

        if ($params) {
            foreach ($params as $key => $val) {
                $webhook->parameter[$key] = $val;
            }
        }

        $webhook->path = "webhooks";

        $webhook->requestType = 'GET';

        return $webhook;
    }

    /**
     * Webhook详情
     * @param string $id
     * @return Webhook
     */
    public static function SelectWebhookShow(string $id)
    {
        $webhook = new Webhook();

        $webhook->path = "webhooks/$id";

        $webhook->requestType = 'GET';

        return $webhook;
    }

    /**
     * 编辑Webhook
     * @param string $id Webhook id
     * @param string $address Webhook通知URL
     * @param string $topic 订阅事件名称
     * @return Webhook
     */
    public static function UpdateWebHook(string $id, string $address, string $topic)
    {
        $webhook = new Webhook();

        $webhook->bodyData['address'] = $address;

        $webhook->bodyData['topic'] = $topic;

        $webhook->path = "webhooks/$id";

        $webhook->requestType = 'PUT';

        return $webhook;
    }


    /**
     * 删除Webhook
     * @param string $id
     * @return Webhook
     */
    public static function DeleteWebHook(string $id)
    {
        $webhook = new Webhook();

        $webhook->path = "webhooks/$id";

        $webhook->requestType = 'DELETE';

        return $webhook;
    }

    /**
     * 统计当前店铺Webhook数量
     * @param string $address Webhook通知URL
     * @param string $topic 订阅事件名称
     * @return Webhook
     */
    public static function CountWebHook(string $address, string $topic)
    {
        $webhook = new Webhook();

        $webhook->parameter['address'] = $address;

        $webhook->parameter['topic'] = $topic;

        $webhook->path = "webhooks/count";

        $webhook->requestType = 'GET';

        return $webhook;
    }
}