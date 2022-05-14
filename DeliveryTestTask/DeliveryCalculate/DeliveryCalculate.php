<?php
namespace DeliveryTestTask\DeliveryCalculate;

use DeliveryTestTask\Delivery\DeliveryCurlClient;
use DeliveryTestTask\Delivery\FastDelivery\FastDelivery;
use DeliveryTestTask\Delivery\SlowDelivery\SlowDelivery;
use DeliveryTestTask\DeliveryCalculate\Data\DeliveryDecoratorListInterface;
use DeliveryTestTask\DeliveryCalculate\Decorator\DecoratorFastDelivery;
use DeliveryTestTask\DeliveryCalculate\Decorator\DecoratorSlowDelivery;

/**
 * Class DeliveryCalculate
 * @package DeliveryTestTask\DeliveryCalculate
 */
class DeliveryCalculate {

    /**
     * @param array $param
     * @param string $baseUrl
     * @return array
     */
    public static function getCalculateDeliveryList(array $param,string $baseUrl){

        $deliveryListArray = self::prepareDeliveryList();

        $result = [];

        /**
         * @param array $deliveryListArray
         * @var $delivery DeliveryDecoratorListInterface
         */
        foreach ($deliveryListArray as $delivery) {

           try{

               if($delivery->getBaseUrl() == $baseUrl){
                   $delivery->setSelect(true);
               }

               $result[] = [
                   'name' => $delivery->getName(),
                   'select' => $delivery->getSelect(),
                   'data' => $delivery->getPriceDelivery($param)
               ];

           } catch (\Exception $exception){
               continue;
           }
        }

        return $result;

    }


    /**
     * @return array
     */
    private static function prepareDeliveryList() :array {

        $curlClient = new DeliveryCurlClient();

        $fastDelivery = new FastDelivery($curlClient);
        $slowDelivery = new SlowDelivery($curlClient);

        $fastDecorator = new DecoratorFastDelivery($fastDelivery);
        $slowDecorator = new DecoratorSlowDelivery($slowDelivery);

        return [
            $fastDecorator,
            $slowDecorator
        ];

    }

}
