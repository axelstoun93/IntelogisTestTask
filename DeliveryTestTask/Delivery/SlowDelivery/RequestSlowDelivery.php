<?php
namespace DeliveryTestTask\Delivery\SlowDelivery;
use DeliveryTestTask\Delivery\AbstractRequestDelivery;

/**
 * Class RequestSlowDelivery
 */
class RequestSlowDelivery extends AbstractRequestDelivery
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
