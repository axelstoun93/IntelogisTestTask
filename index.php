<?php
require_once 'vendor/autoload.php';

use DeliveryTestTask\Delivery\DeliveryCurlClient;
use DeliveryTestTask\Delivery\FastDelivery\FastDelivery;
use DeliveryTestTask\Delivery\SlowDelivery\SlowDelivery;
use DeliveryTestTask\DeliveryCalculate\Decorator\DecoratorFastDelivery;
use DeliveryTestTask\DeliveryCalculate\Decorator\DecoratorSlowDelivery;
use DeliveryTestTask\DeliveryCalculate\DeliveryCalculate;


$params = [
    'sourceKladr' => 'test',
    'targetKladr' => 'test',
    'weight' => 20
];

try {

    $result = DeliveryCalculate::getCalculateDeliveryList($params,'https://yandex.ru/');

    echo json_encode($result);

    //Отдельное использование

    $curlClient = new DeliveryCurlClient();

    $fastDelivery = new FastDelivery($curlClient);
    $slowDelivery = new SlowDelivery($curlClient);

    $fastDecorator = new DecoratorFastDelivery($fastDelivery);
    $slowDecorator = new DecoratorSlowDelivery($slowDelivery);

    // Декоратор
   /* echo json_encode($fastDecorator->getPriceDelivery($params));
    echo json_encode($slowDecorator->getPriceDelivery($params));*/

    // Дефолт ответы от api
  /*  echo json_encode($fastDelivery->getPriceDelivery($params));
    echo json_encode($slowDelivery->getPriceDelivery($params));*/


}catch (Exception $exception) {
    echo $exception->getMessage();
}
