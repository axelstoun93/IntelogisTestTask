<?php

namespace DeliveryTestTask\DeliveryCalculate\Decorator;

use DeliveryTestTask\DeliveryCalculate\Data\DeliveryDecoratorListInterface;

/**
 * Class AbstractDecoratorDeliveryList
 * @package DeliveryTestTask\DeliveryCalculate\Decorator
 */
abstract class AbstractDecoratorDeliveryList implements DeliveryDecoratorListInterface
{

    /**
     * @var bool
     */
    protected bool $select = false;

    /**
     * @return bool
     */
    public function getSelect(): bool
    {
        return $this->select;
    }

    /**
     * @param bool $select
     */
    public function setSelect(bool $select): void
    {
        $this->select = $select;
    }

}

