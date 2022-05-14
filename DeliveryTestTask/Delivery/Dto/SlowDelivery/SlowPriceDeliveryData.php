<?php
namespace DeliveryTestTask\Delivery\Dto\SlowDelivery;

use DeliveryTestTask\Data\DataTransferObjectInterface;

/**
 * Class SlowPriceDeliveryData
 */
class SlowPriceDeliveryData implements DataTransferObjectInterface{

    /**
     * @var float
     */
    public float $coefficient;
    /**
     * @var string
     */
    public string $date;
    /**
     * @var string
     */
    public string $error;

    /**
     * @param array $response
     * @return SlowPriceDeliveryData
     */
    public function fromResponse(array $response) :SlowPriceDeliveryData
    {
        $dto = new self();
        $dto->coefficient =  $response['coefficient'];
        $dto->date = $response['date'];
        $dto->error = $response['error'];
        return $dto;
    }
}
