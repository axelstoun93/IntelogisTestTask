<?php
namespace DeliveryTestTask\Delivery\Data;

/**
 * Interface DeliveryCurlClientInterface
 */
interface DeliveryCurlClientInterface {

    /**
     * @param string $baseUrl
     * @param DeliveryRequestInterface $request
     * @return DeliveryResponseInterface
     */
    public function call(string $baseUrl,DeliveryRequestInterface $request):DeliveryResponseInterface;

}
