<?php

namespace DianJiang;

use DianJiang\API\ResponseStatus;
use JsonMapper;
use DianJiang\API\Request;
use DianJiang\API\Response;
use linslin\yii2\curl\Curl;

class DianJiangAPI
{
    // 私有密钥
    private $accessToken = null;

    private $serializer = null;
    private $shop = null;
    private $curl = null;
    // api 版本
    private static $VERSION = '/2020-07/';

    /**
     * DianJiangAPI constructor.
     * @param $accessToken string 店铺私有TOKEN
     * @param $shop string 店铺名称
     * @throws \Exception
     */
    public function __construct($accessToken, $shop)
    {
        $this->accessToken = $accessToken;

        $this->shop = $shop;

        $this->curl = new Curl();
        $this->serializer = new JsonMapper();
        if (PHP_INT_SIZE != 8)
            throw new \Exception("This Framework works only on x64 Platforms/PHP!");
    }


    /**
     * 请求数据
     * @param Request $request
     * @throws \Exception
     */
    public function sendRequest(Request $request)
    {
        $url = 'https://' . $this->shop . 'myshoplaza.com/openapi' . self::$VERSION . $request->path;

        /* @var Response */
        $response = new Response($request);

        $client = $this->curl
            ->setHeaders([
                'Content-Type' => 'application/json',
                'Access-Token' => $this->accessToken,

            ]);

        // 判断请求类型
        if ($request->postData != null) {
            $client->setRequestBody(json_encode($request->postData))
                ->setHeaders(['content-length' => strlen(json_encode($request->postData))])
                ->post($url);
        } else {
            $client->get($url);
        }


        // 获取请求Code
        $responseCode = $client->responseCode;

        if ($responseCode == 200) {
            try {

                $resources = json_decode($client);

                if ($resources == null || $resources === false)  throw new \Exception("Failed to parse JSON");

                $response = $this->serializer->map($resources, new Response($request));

                $response->status = ResponseStatus::OK;

            } catch (\Exception $e) {

                $response->status = ResponseStatus::REQUEST_FAILED;
                throw $e;
            }
        } else {
            try {
                $resources = json_decode($client);

                if ($resources == null || $resources === false)  throw new \Exception("Failed to parse JSON");

                $response = $this->serializer->map($resources, new Response($request));

                switch ($responseCode) {
                    case 'timeout':
                        $response->status = ResponseStatus::FAIL;
                        break;
                    case 400:
                        $response->status = ResponseStatus::REQUEST_REJECTED;
                        break;
                    case 402:
                        $response->status = ResponseStatus::PAYMENT_REQUIRED;
                        break;
                    case 405:
                        $response->status = ResponseStatus::METHOD_NOT_ALLOWED;
                        break;
                    case 429:
                        $response->status = ResponseStatus::NOT_ENOUGH_TOKEN;
                        break;
                    default:
                        $response->error = $client;
                        $response->status = ResponseStatus::REQUEST_FAILED;
                        break;
                }
            } catch (\Exception $e) {
                $response->status = ResponseStatus::REQUEST_FAILED;
                throw $e;
            }
        }

        $response->url = $url;

        return $response;
    }


}