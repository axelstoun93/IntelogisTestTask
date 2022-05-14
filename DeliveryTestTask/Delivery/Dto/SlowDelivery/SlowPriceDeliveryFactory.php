<?php
namespace DeliveryTestTask\Delivery\Dto\SlowDelivery;

/**
 * Class SlowPriceDeliveryFactory
 */
class SlowPriceDeliveryFactory {

    /**
     * @param array $response
     * @return SlowPriceDeliveryData
     */
    public function create(array $response): SlowPriceDeliveryData
    {
        $dtoSlowPriceDeliveryData = new SlowPriceDeliveryData();
        return $dtoSlowPriceDeliveryData->fromResponse($response);
    }
}
