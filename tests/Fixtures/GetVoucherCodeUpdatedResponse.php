<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
{
    "uuid": "00000000-0000-0000-0000-000000000000",
    "user": {
        "username": "max.muster",
        "firstName": "Max",
        "lastName": "Muster",
        "status": {
            "membership": "ACADEMIC_BRONZE"
        }
    },
    "company": null,
    "voucherCode": "00000000-0000-0000-0000-000000000000",
    "title": "Event Voucher Updated",
    "description": "200 EUR discount for one event ticket",
    "type": "EVENTS",
    "status": "NEW",
    "expiresAt": "2030-01-10T00:00:00+00:00",
    "usages": 1,
    "redemptions": 0,
    "isExpired": false,
    "isUsed": false,
    "isRedeemable": true
}
');
