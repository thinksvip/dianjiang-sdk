<?php

namespace DianJiang;

use DianJiang\API\ResponseStatus;
use DianJiang\API\Webhook;
use JsonMapper;
use DianJiang\API\Request;
use DianJiang\API\Response;
use linslin\yii2\curl\Curl;
use yii\base\Exception;

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

        $this->serializer = new JsonMapper();
        if (PHP_INT_SIZE != 8)
            throw new \Exception("This Framework works only on x64 Platforms/PHP!");
    }


    /**
     * 请求数据
     * @param Request $request
     * @return Response|object
     * @throws \Exception
     */
    public function sendRequest(Request $request)
    {
        $url = 'https://' . $this->shop . '.myshoplaza.com/openapi' . self::$VERSION . $request->path;

        /* @var Response */
        $response = new Response($request);

        $this->curl = new Curl();

        $client = $this->curl
            ->setHeaders([
                'Content-Type' => 'application/json',
                'Access-Token' => $this->accessToken,
            ]);

        // 判断请求类型
        $method = strtolower($request->method);
        switch ($method){
            case 'get':
                break;
            case 'put':
            case 'post':
            switch (strtolower($request->dataType)){
                case 'form':
                    $params = is_array($request->bodyData) ? $request->bodyData : [];
                    $client = $client->setPostParams($params)->setHeaders(['content-length' => strlen(json_encode($request->bodyData))]);
                    break;
                case 'json':
                default:
                    $params = is_array($request->bodyData) ? json_encode($request->bodyData, JSON_UNESCAPED_UNICODE) : json_encode([]);
                    $client = $client->setRequestBody($params);
                    break;
            }
                break;
        }

        //发起请求
        $client->$method($url);


        /*if ($request->postData != null) {
            $client->setRequestBody(json_encode($request->postData))
                ->setHeaders(['content-length' => strlen(json_encode($request->postData))])
                ->post($url);
        } else {
            $client->get($url);
        }*/

        // 获取请求Code
        $responseCode = $client->responseCode;
        if ($responseCode == 200) {
            try {

                $resources = json_decode($client->response);

                if ($resources == null || $resources === false)  throw new \Exception("Failed to parse JSON");

                $response = $this->serializer->map($resources,new Response($request));
                $response->status = ResponseStatus::OK;
            } catch (\Exception $e) {

                $response->status = ResponseStatus::REQUEST_FAILED;
                throw $e;
            }
        } else {
            try {

                $resources = json_decode($client->response);

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
                    case 422:
                        $response->status = ResponseStatus::BUSINESS_EXCEPTION;
                        $response->error = $client->response;
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

    /**
     * 请求Webhook
     * @param Webhook $webhook
     * @return mixed
     * @throws Exception
     */
    public function sendWebhook(Webhook $webhook)
    {
        /* @var Response */
        $response = new Response($webhook);

        $url = 'https://' . $this->shop . '.myshoplaza.com/openapi' . self::$VERSION . $webhook->path;

        $this->curl = new Curl();

        $client = $this->curl
            ->setHeaders([
                'Content-Type' => 'application/json',
                'Access-Token' => $this->accessToken,
            ]);

        switch ($webhook->requestType){
            case 'GET':
                $client->get($url);
                break;
            case 'PUT':
                $client->setRequestBody(json_encode($webhook->bodyData))
                    ->setHeaders(['content-length' => strlen(json_encode($webhook->bodyData))])
                    ->put($url);
                break;
            case 'DELETE':
                $client->delete($url);
                break;
            case 'POST':
                $client->setRequestBody(json_encode($webhook->bodyData))
                    ->setHeaders(['content-length' => strlen(json_encode($webhook->bodyData))])
                    ->post($url);
                break;
            default:
                throw new Exception('请求类型有误，请判断请求类型');
        }

        try {

            $resources = json_decode($client->response);

            switch ($client->responseCode) {
                case 200:
                    if (!$resources == null || !$resources === false) $response = $this->serializer->map($resources,new Response($webhook));
                    $response->status = ResponseStatus::OK;
                    break;
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
                    $response->error = $client->response;
                    $response->status = ResponseStatus::REQUEST_FAILED;
                    break;
            }
        } catch (\Exception $e) {
            $response->status = ResponseStatus::REQUEST_FAILED;
            throw $e;
        }

        $response->url = $url;

        return $response;

    }


}