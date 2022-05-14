<?php
namespace DeliveryTestTask\DeliveryCalculate\Dto;
use DeliveryTestTask\Data\DataTransferObjectInterface;

/**
 * Class DeliveryCalculateData
 */
class DeliveryCalculateData implements DataTransferObjectInterface
{

    /**
     * @var float
     */
    public float $price;
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
     * @return $this
     */
    public function fromResponse(array $response): self
    {
        $dto = new self();
        $dto->price = $response['price'];
        $dto->date = $response['date'];
        $dto->error = $response['error'];
        return $dto;
    }
}
