<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Notification\IncompletePaymentNotification;
use T3G\DatahubApiLibrary\Notification\NotificationInterface;
use T3G\DatahubApiLibrary\Notification\UnknownNotification;

/**
 * @extends AbstractFactory<NotificationInterface>
 */
class NotificationFactory extends AbstractFactory
{
    /**
     * @param array<string, mixed> $data
     *
     * @return NotificationInterface
     */
    public static function fromArray(array $data): NotificationInterface
    {
        if (($data['type'] ?? '') === IncompletePaymentNotification::class) {
            return new IncompletePaymentNotification(
                $data['company'],
                $data['companyTitle'],
                $data['subscription'],
                $data['stripeLink']
            );
        }

        return new UnknownNotification($data['type']);
    }
}
