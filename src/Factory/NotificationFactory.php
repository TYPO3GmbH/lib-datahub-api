<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Notification\IncompletePaymentNotification;
use T3G\DatahubApiLibrary\Notification\NotificationInterface;
use T3G\DatahubApiLibrary\Notification\UnknownNotification;

class NotificationFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): NotificationInterface
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    /**
     * @param array<string, mixed> $data
     * @return NotificationInterface
     */
    public static function fromArray(array $data): NotificationInterface
    {
        switch ($data['type'] ?? '') {
            case IncompletePaymentNotification::class:
                $notification = new IncompletePaymentNotification(
                    $data['company'],
                    $data['subscription'],
                    $data['stripeLink']
                );
                break;
            default:
                // unknown notification type
                $notification = new UnknownNotification($data['type']);
                break;
        }
        return $notification;
    }
}
