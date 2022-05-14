<?php
namespace DeliveryTestTask\Delivery;

use DeliveryTestTask\Delivery\Data\DeliveryResponseInterface;

/**
 * Class AbstractResponseDelivery
 */
abstract class AbstractResponseDelivery implements DeliveryResponseInterface {

    /**
     * @var array
     */
    protected array $response;

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * @param array $response
     */
    public function setResponse(array $response): void
    {
        $this->response = $response;
    }

    /**
     * @return bool
     */
    public function isErrorResponse(): bool
    {
        return !empty($this->response['error']);
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->response['error'];
    }

}
