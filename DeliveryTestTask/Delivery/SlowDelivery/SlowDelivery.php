<?php
namespace DeliveryTestTask\Delivery\SlowDelivery;

use DeliveryTestTask\Delivery\Data\DeliveryServiceInterface;
use DeliveryTestTask\Delivery\DeliveryCurlClient;
use DeliveryTestTask\Delivery\Dto\SlowDelivery\SlowPriceDeliveryData;
use DeliveryTestTask\Delivery\Dto\SlowDelivery\SlowPriceDeliveryFactory;
use DeliveryTestTask\Delivery\Exceptions\SlowDeliveryException;

/**
 * Class SlowDelivery
 */
class SlowDelivery implements DeliveryServiceInterface {

    /**
     *
     */
    const BASE_PRICE = 150;

    /**
     * @var string
     */
    private string $baseUrl = 'https://www.google.com/';
    /**
     * @var DeliveryCurlClient
     */
    private DeliveryCurlClient $curlClient;
    /**
     * @var SlowPriceDeliveryFactory
     */
    private SlowPriceDeliveryFactory $slowPriceDeliveryFactory;

    /**
     * SlowDelivery constructor.
     * @param DeliveryCurlClient $curlClient
     */
    public function __construct(DeliveryCurlClient $curlClient)
    {
        $this->curlClient = $curlClient;
        $this->slowPriceDeliveryFactory = new SlowPriceDeliveryFactory();
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
     * @return SlowPriceDeliveryData
     * @throws SlowDeliveryException
     */
    public function getPriceDelivery(array $params) :SlowPriceDeliveryData
    {
        $request = new RequestSlowDelivery();
        $request->setParams($params);
        $response = $this->curlClient->call($this->baseUrl, $request);

        if ($response->isErrorResponse()) {
            $this->errorHandler($response);
        }

        return $this->slowPriceDeliveryFactory->create($response->getResponse());
    }

    /**
     * @param ResponseSlowDelivery $response
     * @throws SlowDeliveryException
     */
    private function errorHandler(ResponseSlowDelivery $response): void
    {
        throw new SlowDeliveryException($response->getError());
    }
}
