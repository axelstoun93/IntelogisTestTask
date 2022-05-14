<?php
namespace DeliveryTestTask\Delivery\Data;

/**
 * Interface DeliveryRequestInterface
 */
interface DeliveryRequestInterface {
    /**
     * @param array $params
     */
    public function setParams(array $params): void;

    /**
     * @return array
     */
    public function getParams(): array;

}
