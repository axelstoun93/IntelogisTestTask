<?php
namespace DeliveryTestTask\Delivery\FastDelivery;
use DeliveryTestTask\Delivery\AbstractRequestDelivery;

/**
 * Class RequestFastDelivery
 */
class RequestFastDelivery extends AbstractRequestDelivery
{

    /**
     * @var string
     */
    public string $sourceKladr;
    /**
     * @var string
     */
    public string $targetKladr;
    /**
     * @var float
     */
    public float  $weight;

    /**
     * @var array
     */
    private array $response;

    /**
     * @return array
     */
    public function getParams(): array
    {
        return (array)$this;
    }

}
