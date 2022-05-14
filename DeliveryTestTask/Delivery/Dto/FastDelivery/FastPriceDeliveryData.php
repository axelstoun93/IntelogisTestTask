<?php
namespace DeliveryTestTask\Delivery\Dto\FastDelivery;

use DeliveryTestTask\Data\DataTransferObjectInterface;

/**
 * Class FastPriceDeliveryData
 */
class FastPriceDeliveryData implements DataTransferObjectInterface
{

    /**
     * @var float
     */
    public float $price;
    /**
     * @var int
     */
    public int $period;
    /**
     * @var string
     */
    public string $error;

    /**
     * @param array $response
     * @return FastPriceDeliveryData
     */
    public function fromResponse(array $response): FastPriceDeliveryData
    {
        $dto = new self();
        $dto->price = $response['price'];
        $dto->period = $response['period'];
        $dto->error = $response['error'];
        return $dto;
    }
}
