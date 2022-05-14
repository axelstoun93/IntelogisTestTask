<?php
namespace DeliveryTestTask\Delivery\Data;
use DeliveryTestTask\Data\DataTransferObjectInterface;

/**
 * Interface DeliveryServiceInterface
 */
interface DeliveryServiceInterface {

    /**
     * @param array $params
     * @return DataTransferObjectInterface
     */
    public function getPriceDelivery(array $params) :DataTransferObjectInterface;

    /**
     * @return string
     */
    public function getBaseUrl():string;

}
