<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\Invoice;
use T3G\DatahubApiLibrary\Entity\Order;

class OrderFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): Order
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    public static function fromArray(array $data): Order
    {
        $order = (new Order())
            ->setUuid($data['uuid'])
            ->setOrderNumber($data['orderNumber'])
            ->setPayload($data['payload'])
            ->setCreatedAt(isset($data['createdAt']) ? new \DateTime($data['createdAt']) : new \DateTime());

        foreach ($data['invoices'] ?? [] as $invoice) {
            $order->addInvoice(
                (new Invoice())
                    ->setLink($invoice['link'])
                    ->setDate(new \DateTime($invoice['date']))
                    ->setTitle($invoice['title'] ?? null)
            );
        }

        return $order;
    }
}
