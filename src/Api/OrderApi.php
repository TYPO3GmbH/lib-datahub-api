<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Demand\OrderSearchDemand;
use T3G\DatahubApiLibrary\Entity\Invoice;
use T3G\DatahubApiLibrary\Entity\Order;
use T3G\DatahubApiLibrary\Entity\OrderList;
use T3G\DatahubApiLibrary\Factory\OrderFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class OrderApi extends AbstractApi
{
    use HandlesUuids;

    public function getOrder(string $uuid): Order
    {
        $this->isValidUuidOrThrow($uuid);

        return OrderFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/order/' . $uuid)
            )
        );
    }

    /**
     * @param OrderSearchDemand $orderSearchDemand
     * @param int|null $limit
     * @param int|null $offset
     * @return OrderList
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \T3G\DatahubApiLibrary\Exception\DatahubResponseException
     * @throws \JsonException
     */
    public function searchOrders(OrderSearchDemand $orderSearchDemand, ?int $limit = null, ?int $offset = null): OrderList
    {
        $query = [];
        if (null !== $limit) {
            $query['page']['limit'] = $limit;
        }
        if (null !== $offset) {
            $query['page']['offset'] = $offset;
        }
        return OrderFactory::fromResponseDataCollection(
            $this->client->request(
                'POST',
                self::uri('/order/search')->withQuery(http_build_query($query)),
                json_encode($orderSearchDemand, JSON_FORCE_OBJECT | JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @deprecated since 16.07.2020, will be remove after 16.01.2021. Use createOrderForUser or createOrderForCompany instead
     */
    public function createOrder(string $username, Order $order): Order
    {
        trigger_error(__METHOD__ . ' has been marked as deprecated and will be removed after 16.01.2021. Use createOrderForUser or createOrderForCompany instead', E_USER_DEPRECATED);
        return $this->createOrderForUser($username, $order);
    }

    public function createOrderForUser(string $username, Order $order): Order
    {
        return OrderFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/orders'),
                json_encode($order, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function createOrderForCompany(string $uuid, Order $order): Order
    {
        $this->isValidUuidOrThrow($uuid);

        return OrderFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/companies/' . $uuid . '/orders'),
                json_encode($order, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function updateOrder(string $uuid, Order $order): Order
    {
        $this->isValidUuidOrThrow($uuid);

        return OrderFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/order/' . $uuid),
                json_encode($order, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function addInvoice(string $orderUuid, Invoice $invoice): Order
    {
        $this->isValidUuidOrThrow($orderUuid);

        return OrderFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri(sprintf('/order/%s/invoice', $orderUuid)),
                json_encode($invoice, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function deleteOrder(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/order/' . $uuid)
        );
    }
}
