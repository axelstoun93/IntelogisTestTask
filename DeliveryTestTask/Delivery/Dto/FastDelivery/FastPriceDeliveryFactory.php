<?php
namespace DeliveryTestTask\Delivery\Dto\FastDelivery;

/**
 * Class FastPriceDeliveryFactory
 */
class FastPriceDeliveryFactory {

    /**
     * @param array $response
     * @return FastPriceDeliveryData
     */
    public function create(array $response): FastPriceDeliveryData
    {
        $dtoFastPriceDeliveryData = new FastPriceDeliveryData();
        return $dtoFastPriceDeliveryData->fromResponse($response);
    }
}
