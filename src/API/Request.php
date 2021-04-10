<?php
namespace DianJiang\API;

class Request
{
    //@var HashMap<String, String>
    public $parameter = [];
    //@var string
    public $postData;
    //@var string
    public $path;

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

        $request->parameter['placed_at_min'] = $placed_at_min;

        $request->parameter['placed_at_max'] = $placed_at_max;

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

}