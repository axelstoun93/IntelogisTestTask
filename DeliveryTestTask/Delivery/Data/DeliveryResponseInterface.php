<?php
namespace DeliveryTestTask\Delivery\Data;

/**
 * Interface DeliveryResponseInterface
 */
interface DeliveryResponseInterface {

    /**
     * @return bool
     */
    public function isErrorResponse(): bool;

    /**
     * @return string
     */
    public function getError(): string;

    /**
     * @return array
     */
    public function getResponse(): array;

    /**
     * @param array $response
     */
    public function setResponse(array $response): void;

}
