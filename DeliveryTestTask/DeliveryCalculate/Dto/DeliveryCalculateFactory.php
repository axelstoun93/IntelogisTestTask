<?php

namespace DeliveryTestTask\DeliveryCalculate\Dto;


/**
 * Class DeliveryCalculateFactory
 */
class DeliveryCalculateFactory
{
    /**
     * @param array $response
     * @return DeliveryCalculateData
     */
    public function create(array $response): DeliveryCalculateData
    {
        $deliveryCalculateData = new DeliveryCalculateData();
        return $deliveryCalculateData->fromResponse($response);
    }
}
