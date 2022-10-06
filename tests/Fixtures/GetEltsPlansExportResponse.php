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
    "entities": [
        {
            "uuid": "00000000-0000-0000-0000-000000000000",
            "version": "8.7",
            "type": "single",
            "runtimes": [
                {
                    "uuid": "00000000-0000-0000-0000-000000000000",
                    "runtime": "1-1",
                    "paymentStatus": "paid",
                    "order": {
                        "uuid": "b1c5f298-bdea-493e-893a-ec16a08da35a",
                        "orderNumber": "GELTS123",
                        "createdAt": "2020-05-12T05:55:59+00:00"
                    }
                },
                {
                    "uuid": "55555555-5555-5555-5555-555555555555",
                    "runtime": "2-3",
                    "paymentStatus": "pending",
                    "order": null
                }
            ],
            "owner": "user:max.muster"
        },
        {
            "uuid": "11111111-1111-1111-1111-111111111111",
            "version": "8.7",
            "type": "agency",
            "runtimes": [
                {
                    "uuid": "11111111-1111-1111-1111-111111111111",
                    "runtime": "2-2",
                    "paymentStatus": "paid",
                    "order": {
                        "uuid": "1861f4cc-a87a-46c0-bb5a-3529a54dad32",
                        "orderNumber": "GELTS234",
                        "createdAt": "2020-05-12T05:55:59+00:00"
                    }
                }
            ],
            "owner": "organization:00000000-0000-0000-0000-000000000000"
        },
        {
            "uuid": "22222222-2222-2222-2222-222222222222",
            "version": "8.7",
            "type": "pro",
            "runtimes": [
                {
                    "uuid": "22222222-2222-2222-2222-222222222222",
                    "runtime": "2-3",
                    "paymentStatus": "paid",
                    "order": null
                }
            ],
            "owner": "organization:00000000-0000-0000-0000-000000000000"
        },
        {
            "uuid": "44444444-4444-4444-4444-444444444444",
            "version": "8.7",
            "type": "agency",
            "runtimes": [
                {
                    "uuid": "33333333-3333-3333-3333-333333333333",
                    "runtime": "2-3",
                    "paymentStatus": "paid",
                    "order": null
                }
            ],
            "owner": "organization:11111111-1111-1111-1111-111111111111"
        },
        {
            "uuid": "55555555-5555-5555-5555-555555555555",
            "version": "7.6",
            "type": "agency",
            "runtimes": [
                {
                    "uuid": "44444444-4444-4444-4444-444444444444",
                    "runtime": "2-3",
                    "paymentStatus": "paid",
                    "order": null
                }
            ],
            "owner": "organization:22222222-2222-2222-2222-222222222222"
        }
    ],
    "length": 5,
    "type": "App\\\\Entity\\\\EltsPlanList"
}
');
