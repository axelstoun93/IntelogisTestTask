<?php

namespace DeliveryTestTask\Delivery;

use DeliveryTestTask\Delivery\Data\DeliveryRequestInterface;
use DeliveryTestTask\Delivery\FastDelivery\RequestFastDelivery;
use DeliveryTestTask\Delivery\FastDelivery\ResponseFastDelivery;
use DeliveryTestTask\Delivery\SlowDelivery\RequestSlowDelivery;
use DeliveryTestTask\Delivery\SlowDelivery\ResponseSlowDelivery;

/**
 * Class DeliveryResponseFactory
 */
class DeliveryResponseFactory
{

    /**
     * @param DeliveryRequestInterface $request
     * @param array $response
     * @return ResponseFastDelivery|ResponseSlowDelivery
     */
    public function create(DeliveryRequestInterface $request, array $response)
    {
        if ($request instanceof RequestFastDelivery) {
            $fastDeliveryResponse = new ResponseFastDelivery();
            $fastDeliveryResponse->setResponse($response);
            return $fastDeliveryResponse;
        }

        if ($request instanceof RequestSlowDelivery) {
            $slowDeliveryResponse = new ResponseSlowDelivery();
            $slowDeliveryResponse->setResponse($response);
            return $slowDeliveryResponse;
        }
    }

}
