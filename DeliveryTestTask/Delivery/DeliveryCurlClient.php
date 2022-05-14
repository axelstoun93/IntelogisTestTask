<?php
namespace DeliveryTestTask\Delivery;

use DeliveryTestTask\Delivery\Data\DeliveryCurlClientInterface;
use DeliveryTestTask\Delivery\Data\DeliveryRequestInterface;
use DeliveryTestTask\Delivery\Data\DeliveryResponseInterface;
use DeliveryTestTask\Delivery\FastDelivery\RequestFastDelivery;
use DeliveryTestTask\Delivery\Exceptions\DeliveryCurlClientException;

/**
 * Class DeliveryCurlClient
 */
class DeliveryCurlClient implements DeliveryCurlClientInterface
{

    /**
     * @var DeliveryResponseFactory
     */
    private DeliveryResponseFactory $deliveryResponseFactory;
    /**
     * @var string
     */
    private string $url;

    /**
     * DeliveryCurlClient constructor.
     */
    public function __construct()
    {
        $this->deliveryResponseFactory = new DeliveryResponseFactory();
    }

    /**
     * @var array|string[]
     */
    private array $defaultHeaders = [
        'Content-Type' => 'application/json; charset=utf-8',
        'Accept' => 'application/json',
    ];

    /**
     * @var
     */
    private $curl;

    /**
     * @var int
     */
    private int $timeout = 80;

    /**
     * @var int
     */
    private int $connectionTimeout = 30;

    /**
     * @param string $url
     * @param DeliveryRequestInterface $request
     * @param array $headers
     * @return DeliveryResponseInterface
     */
    public function call(string $url, DeliveryRequestInterface $request, array $headers = []): DeliveryResponseInterface
    {
        $headers = $this->prepareHeaders($headers);

        $this->setUrl($url);

        $this->prepareCurl($request, $this->implodeHeaders($headers), $this->getUrl());

        /*  list($response,$httpCode) = $this->sendRequest();*/

        $this->closeCurlConnection();

        $request->getParams();

        if ($request instanceof RequestFastDelivery) {
            $response = '{"price":100,"period":2,"error":""}';
        } else {
            $response = '{"coefficient":4.5,"date":"2022-05-14","error":""}';
        }

        return $this->deliveryResponseFactory->create($request, $this->decodeData($response));
    }


    /**
     * @param string $response
     * @return array
     */
    public function decodeData(string $response): array
    {
        return json_decode($response, true);
    }


    /**
     * @return array
     * @throws DeliveryCurlClientException
     */
    public function sendRequest(): array
    {
        $response = curl_exec($this->curl);
        $responseInfo = curl_getinfo($this->curl);
        $curlError = curl_error($this->curl);
        $curlErrno = curl_errno($this->curl);
        if ($response === false) {
            $this->handleCurlError($curlError, $curlErrno);
        }

        return [$response, $responseInfo['http_code']];
    }


    /**
     * @param array $headers
     * @return array
     */
    private function prepareHeaders(array $headers): array
    {
        $headers = array_merge($this->defaultHeaders, $headers);
        return $headers;
    }

    /**
     * @param array $headers
     * @return array
     */
    private function implodeHeaders(array $headers): array
    {
        return array_map(
            function ($key, $value) {
                return $key . ':' . $value;
            },
            array_keys($headers),
            $headers
        );
    }

    /**
     * @param $optionName
     * @param $optionValue
     * @return bool
     */
    public function setCurlOption($optionName, $optionValue)
    {
        return curl_setopt($this->curl, $optionName, $optionValue);
    }

    /**
     * @return false|resource
     * @throws DeliveryCurlClientException
     */
    private function initCurl()
    {
        if (!extension_loaded('curl')) {
            throw new DeliveryCurlClientException('curl error');
        }

        $this->curl = curl_init();

        return $this->curl;
    }

    /**
     *
     */
    public function closeCurlConnection(): void
    {
        if ($this->curl !== null) {
            curl_close($this->curl);
        }
    }

    /**
     * @param string $url
     * @return string
     */
    private function setUrl(string $url): string
    {
        return $this->url = $url;
    }

    /**
     * @return string
     */
    private function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param DeliveryRequestInterface $request
     * @param array $headers
     * @param string $url
     * @throws DeliveryCurlClientException
     */
    private function prepareCurl(DeliveryRequestInterface $request, array $headers, string $url): void
    {
        $this->initCurl();

        $this->setParamUrl($this->url, $request->getParams());

        $this->setCurlOption(CURLOPT_URL, $url);

        $this->setCurlOption(CURLOPT_RETURNTRANSFER, true);

        $this->setCurlOption(CURLOPT_CONNECTTIMEOUT, $this->connectionTimeout);

        $this->setCurlOption(CURLOPT_TIMEOUT, $this->timeout);
    }

    /**
     * @param $url
     * @param array $params
     */
    public function setParamUrl(&$url, array $params): void
    {
        $url = $url . '?' . http_build_query($params);
    }

    /**
     * @param $error
     * @param $errno
     * @throws DeliveryCurlClientException
     */
    private function handleCurlError($error, $errno): void
    {
        $urlError = $this->getUrl();

        switch ($errno) {
            case CURLE_COULDNT_CONNECT:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_OPERATION_TIMEOUTED:
                $msg = "Could not connect to api $urlError. Please check your internet connection and try again.";
                break;
            case CURLE_SSL_CACERT:
            case CURLE_SSL_PEER_CERTIFICATE:
                $msg = 'Could not verify SSL certificate.';
                break;
            default:
                $msg = 'Unexpected error communicating.';
        }
        $msg .= "\n\n(Network error [errno $errno]: $error)";
        throw new DeliveryCurlClientException($msg);
    }

}
