<?php
namespace DianJiang\API;

class Request
{
    //@var HashMap<String, String>
    public $parameter = [];
    //@var HashMap<String, String>
    public $bodyData = [];
    //@var string
    public $path;
    //@var string
    public $method = 'get';
    //@var string
    public $dataType = 'json';


    public function __construct(array $parameter = null)
    {
        $this->parameter = $parameter;
    }


    /**
     * 获取订单列表
     * @param string $placed_at_min 起始订单支付时间
     * @param string $placed_at_max 结束订单支付时间
     * @param string $financial_status 订单支付状态 waiting(待支付)，paying(支付中)，paid(已支付)，cancelled(已取消)，failed(失败)，refunding(退款中)，refund_failed(退款失败)，refunded(已退款), partially_refunded(部分退款)
     * @param array|null $params 附加请求参数 数组形式
     */
    public static function getOrdersRequest(string $placed_at_min,string $placed_at_max,string $financial_status,array $params = null)
    {
        $request = new Request();

        $request->parameter['placed_at_min'] = date(DATE_ISO8601,strtotime($placed_at_min));

        $request->parameter['placed_at_max'] = date(DATE_ISO8601,strtotime($placed_at_max));

        $request->parameter['financial_status'] = $financial_status;

        if ($params) {
            foreach ($params as $key => $val) {
                $request->parameter[$key] = $val;
            }
        }

        $request->path = "orders" . "?" . $request->query();

        return $request;
    }

    /**
     * 获取订单详情
     * @param string $id
     */
    public static function getOrderRequest(string $id)
    {
        $request = new Request();
        $request->path = "orders/$id";

        return $request;
    }

    /**
     * 拼接GET请求字段
     * @return string
     */
    public function query()
    {
        if ($this->parameter == null || count($this->parameter) == 0)
            return "";
        else
            $query = http_build_query($this->parameter, "", "&");
        return $query;
    }

    /**
     * 创建运单
     * @param string $order_id 订单号
     * @param array $line_item_ids 运单包含的Line Item ID数组
     * @param string $tracking_number 运单号
     * @param string $tracking_company 物流公司名称
     * @param string $tracking_company_code 物流公司代码
     */
    public static function createFulfillments(string $order_id,array $line_item_ids,string $tracking_number,string $tracking_company=null,string $tracking_company_code=null)
    {
        $request = new Request();

        $request->bodyData['line_item_ids'] = $line_item_ids;
        $request->bodyData['tracking_number'] = $tracking_number;
        $request->bodyData['tracking_company'] = $tracking_company;
        $request->bodyData['tracking_company_code'] = $tracking_company_code;

        $request->method = 'post';
        $request->path = "orders/{$order_id}/fulfillments";
        return $request;
    }

    /**
     * 获取运单列表
     * @param string $order_id 订单号
     * @param array|null $params 附加请求参数 数组形式
     */
    public static function getFulfillmentsRequest(string $order_id,array $params = null)
    {
        $request = new Request();

        if ($params) {
            foreach ($params as $key => $val) {
                $request->parameter[$key] = $val;
            }
        }
        $request->method = 'get';
        $request->path = "orders/{$order_id}/fulfillments" . "?" . $request->query();
        return $request;
    }

    /**
     * 获取运单详情
     * @param string $order_id 订单号
     * @param string $fulfillment_id 运单id
     */
    public static function getFulfillmentRequest(string $order_id,string $fulfillment_id)
    {
        $request = new Request();
        $request->method = 'get';
        $request->path = "orders/{$order_id}/fulfillments/{$fulfillment_id}";
        return $request;
    }

    /**
     * 更新运单
     * @param string $order_id 订单号
     * @param string $fulfillment_id 运单id
     * @param string $tracking_number 运单号
     * @param string $tracking_company 物流公司名称
     * @param string $tracking_company_code 物流公司代码
     */
    public static function saveFulfillment(string $order_id,string $fulfillment_id,string $tracking_number,string $tracking_company=null,string $tracking_company_code=null)
    {
        $request = new Request();
        $request->bodyData['tracking_number'] = $tracking_number;
        $request->bodyData['tracking_company'] = $tracking_company;
        $request->bodyData['tracking_company_code'] = $tracking_company_code;
        $request->method = 'put';
        $request->path = "orders/{$order_id}/fulfillments/{$fulfillment_id}";
        return $request;
    }

    /**
     * 完成运单
     * @param string $order_id 订单号
     * @param string $fulfillment_id 运单id
     */
    public static function completeFulfillment(string $order_id,string $fulfillment_id)
    {
        $request = new Request();
        $request->method = 'post';
        $request->path = "orders/{$order_id}/fulfillments/{$fulfillment_id}/complete";
        return $request;
    }

    /**
     * 取消运单
     * @param string $order_id 订单号
     * @param string $fulfillment_id 运单id
     */
    public static function cancelFulfillment(string $order_id,string $fulfillment_id)
    {
        $request = new Request();
        $request->method = 'post';
        $request->path = "orders/{$order_id}/fulfillments/{$fulfillment_id}/cancel";
        return $request;
    }
}