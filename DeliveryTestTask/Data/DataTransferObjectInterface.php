<?php
namespace DeliveryTestTask\Data;

/**
 * Interface DataTransferObjectInterface
 */
interface DataTransferObjectInterface
{
    /**
     * @param array $response
     */
    public function fromResponse(array $response) :DataTransferObjectInterface;
}
