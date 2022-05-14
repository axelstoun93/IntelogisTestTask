<?php
namespace DeliveryTestTask\DeliveryCalculate\Decorator;

use DeliveryTestTask\Delivery\Dto\FastDelivery\FastPriceDeliveryData;
use DeliveryTestTask\Delivery\FastDelivery\FastDelivery;
use DeliveryTestTask\DeliveryCalculate\Dto\DeliveryCalculateData;
use DeliveryTestTask\DeliveryCalculate\Dto\DeliveryCalculateFactory;

/**
 * Class DecoratorFastDelivery
 */
class DecoratorFastDelivery extends AbstractDecoratorDeliveryList {

    /**
     * @var FastDelivery
     */
    private FastDelivery $slowDeliveryObject;
    /**
     * @var DeliveryCalculateFactory
     */
    private DeliveryCalculateFactory $deliveryCalculateFactory;

    /**
     * DecoratorFastDelivery constructor.
     * @param FastDelivery $slowDelivery
     */
    public function __construct(FastDelivery $slowDelivery){
        $this->slowDeliveryObject = $slowDelivery;
        $this->deliveryCalculateFactory = new DeliveryCalculateFactory();
    }

    /**
     * @return string
     */
    public function getName() :string{
        return 'fast_delivery';
    }

    /**
     * @return string
     */
    public function getBaseUrl() :string{
        return $this->slowDeliveryObject->getBaseUrl();
    }

    /**
     * @param array $params
     * @return DeliveryCalculateData
     * @throws \DeliveryTestTask\Delivery\Exceptions\FastDeliveryException
     */
    public function getPriceDelivery(array $params) :DeliveryCalculateData {

        $fastPriceDeliveryData = $this->slowDeliveryObject->getPriceDelivery($params);
        $price = $fastPriceDeliveryData->price;
        $date =  $this->getDate($fastPriceDeliveryData);
        $error = $fastPriceDeliveryData->error;

        return $this->deliveryCalculateFactory->create([
           'price' => $price,
           'date' => $date,
           'error'=> $error
        ]);
    }

    /**
     * @param FastPriceDeliveryData $fastPriceDeliveryData
     * @return string
     */
    private function getDate(FastPriceDeliveryData $fastPriceDeliveryData) :string {
        $dayInt = $fastPriceDeliveryData->period;
        return date('Y-m-d', strtotime("+$dayInt days"));
    }
}
