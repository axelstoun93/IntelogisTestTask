<?php
namespace DeliveryTestTask\DeliveryCalculate\Data;
use DeliveryTestTask\DeliveryCalculate\Dto\DeliveryCalculateData;

/**
 * Interface DeliveryDecoratorListInterface
 */
interface DeliveryDecoratorListInterface {
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getBaseUrl(): string;

    /**
     * @return bool
     */
    public function getSelect(): bool;

    /**
     * @param bool $select
     */
    public function setSelect(bool $select): void;

    /**
     * @param array $param
     * @return DeliveryCalculateData
     */
    public function getPriceDelivery(array $param): DeliveryCalculateData;
}
