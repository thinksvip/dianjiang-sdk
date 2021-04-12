# DianJiang API Framework
## Features
    · 通过此API，可以快速获取 PHP Object
## Composer
```
composer require thinksvip/dianjiang-sdk: *
```
# Quick Example

## Make an API request
```php
<?php


use DianJiang\API\Request;
use DianJiang\DianJiangAPI;

    // 获取授权信息
    $api = new DianJiangAPI('Access-Token','YOU_SHOP_NAME');

    // 组装请求商品列表数据
    $r = Request::getOrdersRequest("2021-04-09 08:40:17","2021-04-12 08:40:17",'paid');

    // 发起请求 获取数据
    $response = $api->sendRequest($r);

    switch ($response->status) {
        case ResponseStatus::OK:
            foreach ($response->orders as $order) {
                // 获取订单id
                print_r($order->id);
                // 获取商品全部信息
                print_r($order->line_item);
                // 获取商品标题
                print_r($order->line_item->product_title);

            }
            break;
        default:
            print_r($response);
            break;
    }

```