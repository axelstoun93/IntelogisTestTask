<?php
namespace DeliveryTestTask\DeliveryCalculate\Decorator;

use DeliveryTestTask\Delivery\Dto\SlowDelivery\SlowPriceDeliveryData;
use DeliveryTestTask\Delivery\SlowDelivery\SlowDelivery;
use DeliveryTestTask\DeliveryCalculate\Dto\DeliveryCalculateData;
use DeliveryTestTask\DeliveryCalculate\Dto\DeliveryCalculateFactory;

/**
 * Class DecoratorSlowDelivery
 */
class DecoratorSlowDelivery extends AbstractDecoratorDeliveryList
{

    /**
     * @var SlowDelivery
     */
    private SlowDelivery $slowDeliveryObject;
    /**
     * @var DeliveryCalculateFactory
     */
    private DeliveryCalculateFactory $deliveryCalculateFactory;


    /**
     * DecoratorSlowDelivery constructor.
     * @param SlowDelivery $slowDelivery
     */
    public function __construct(SlowDelivery $slowDelivery)
    {
        $this->slowDeliveryObject = $slowDelivery;
        $this->deliveryCalculateFactory = new DeliveryCalculateFactory();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'slow_delivery';
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->slowDeliveryObject->getBaseUrl();
    }

    /**
     * @param array $params
     * @return DeliveryCalculateData
     * @throws \DeliveryTestTask\Delivery\Exceptions\SlowDeliveryException
     */
    public function getPriceDelivery(array $params): DeliveryCalculateData
    {
        $slowPriceDeliveryData = $this->slowDeliveryObject->getPriceDelivery($params);
        $price = $this->getPrice($slowPriceDeliveryData);
        $date = $slowPriceDeliveryData->date;
        $error = $slowPriceDeliveryData->error;

        return $this->deliveryCalculateFactory->create(
            [
                'price' => $price,
                'date' => $date,
                'error' => $error
            ]
        );
    }

    /**
     * @param SlowPriceDeliveryData $slowPriceDeliveryData
     * @return float
     */
    private function getPrice(SlowPriceDeliveryData $slowPriceDeliveryData): float
    {
        return (float)$slowPriceDeliveryData->coefficient * SlowDelivery::BASE_PRICE;
    }

}
