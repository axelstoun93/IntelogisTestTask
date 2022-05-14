<?php
namespace DeliveryTestTask\Delivery\FastDelivery;

use DeliveryTestTask\Delivery\Data\DeliveryServiceInterface;
use DeliveryTestTask\Delivery\DeliveryCurlClient;
use DeliveryTestTask\Delivery\Dto\FastDelivery\FastPriceDeliveryData;
use DeliveryTestTask\Delivery\Dto\FastDelivery\FastPriceDeliveryFactory;
use DeliveryTestTask\Delivery\Exceptions\FastDeliveryException;

/**
 * Class FastDelivery
 */
class FastDelivery implements DeliveryServiceInterface
{

    /**
     * @var string
     */
    private string $baseUrl = 'https://yandex.ru/';
    /**
     * @var DeliveryCurlClient
     */
    private DeliveryCurlClient $curlClient;
    /**
     * @var FastPriceDeliveryFactory
     */
    private FastPriceDeliveryFactory $fastPriceDeliveryFactory;

    /**
     * FastDelivery constructor.
     * @param DeliveryCurlClient $curlClient
     */
    public function __construct(DeliveryCurlClient $curlClient)
    {
        $this->curlClient = $curlClient;
        $this->fastPriceDeliveryFactory = new FastPriceDeliveryFactory();
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param array $params
     * @return FastPriceDeliveryData
     * @throws FastDeliveryException
     */
    public function getPriceDelivery(array $params): FastPriceDeliveryData
    {
        $request = new RequestFastDelivery();
        $request->setParams($params);
        $response = $this->curlClient->call($this->baseUrl, $request);

        if ($response->isErrorResponse()) {
            $this->errorHandler($response);
        }

        return $this->fastPriceDeliveryFactory->create($response->getResponse());
    }

    /**
     * @param ResponseFastDelivery $response
     * @throws FastDeliveryException
     */
    private function errorHandler(ResponseFastDelivery $response): void
    {
        throw new FastDeliveryException($response->getError());
    }

}
