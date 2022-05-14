<?php
namespace DeliveryTestTask\Delivery;

use DeliveryTestTask\Delivery\Data\DeliveryRequestInterface;

/**
 * Class AbstractRequestDelivery
 */
abstract class AbstractRequestDelivery implements DeliveryRequestInterface {

    /**
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $arrayObjectProperty = get_class_vars(static::class);

        foreach ($arrayObjectProperty as $key => $property) {
            if (!empty($params[$key])) {
                $this->$key = $params[$key];
            }
        }
    }

}
