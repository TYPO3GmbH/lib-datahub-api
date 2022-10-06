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
    "version": "8.7",
    "type": "single",
    "validFrom": "2020-04-01T00:00:00+00:00",
    "validTo": "2023-03-31T00:00:00+00:00",
    "runtimes": [
        {
            "uuid": "00000000-0000-0000-0000-000000000000",
            "runtime": "1-3",
            "validFrom": "2020-04-01T00:00:00+00:00",
            "validTo": "2023-03-31T00:00:00+00:00",
            "paymentStatus": "paid",
            "order": {
                "uuid": "b1c5f298-bdea-493e-893a-ec16a08da35a",
                "orderNumber": "GELTS123",
                "payload": {
                    "items": [
                        {
                            "title": "ELTS Order",
                            "quantity": 1
                        }
                    ]
                },
                "createdAt": "2020-05-12T05:55:59+00:00",
                "invoices": []
            }
        }
    ],
    "extendables": [],
    "instances": [
        {
            "uuid": "00000000-0000-0000-0000-000000000000",
            "name": "Single instance",
            "releaseNotifications": [
                {
                    "uuid": "00000000-0000-0000-0000-000000000000",
                    "name": "From Plan 1",
                    "email": "from-plan1@typo3.com",
                    "inherited": true,
                    "owner": "user:max.muster",
                    "accepted": false
                },
                {
                    "uuid": "11111111-1111-1111-1111-111111111111",
                    "name": "From Plan 2",
                    "email": "from-plan2@typo3.com",
                    "inherited": true,
                    "owner": "user:max.muster",
                    "accepted": true
                },
                {
                    "uuid": "22222222-2222-2222-2222-222222222222",
                    "name": "From Instance 1",
                    "email": "from-instance1@typo3.com",
                    "inherited": false,
                    "owner": "user:max.muster",
                    "accepted": true
                }
            ],
            "technicalContacts": [
                {
                    "uuid": "00000000-0000-0000-0000-000000000000",
                    "firstName": "From Plan 1",
                    "lastName": "From Plan 1",
                    "email": "from-plan-1@typo3.com",
                    "accepted": false,
                    "inherited": true,
                    "username": "plan1_1"
                },
                {
                    "uuid": "11111111-1111-1111-1111-111111111111",
                    "firstName": "From Plan 2",
                    "lastName": "From PLan 2",
                    "email": "from-plan-2@example.com",
                    "accepted": false,
                    "inherited": true,
                    "username": null
                },
                {
                    "uuid": "22222222-2222-2222-2222-222222222222",
                    "firstName": "From Instance 1",
                    "lastName": "From Instance 1",
                    "email": "from-instance-1@typo3.com",
                    "accepted": false,
                    "inherited": false,
                    "username": "instance1_1"
                },
                {
                    "uuid": "33333333-3333-3333-3333-333333333333",
                    "firstName": "From Instance 2",
                    "lastName": "From Instance 2",
                    "email": "from-Instance-2@example.com",
                    "accepted": false,
                    "inherited": false,
                    "username": null
                }
            ],
            "owner": "user:max.muster",
            "ownerData": {
                "title": "Max Muster",
                "email": "max@example.com"
            }
        }
    ],
    "licenses": 1,
    "order": {
        "uuid": "b1c5f298-bdea-493e-893a-ec16a08da35a",
        "orderNumber": "GELTS123",
        "payload": {
            "items": [
                {
                    "title": "ELTS Order",
                    "quantity": 1
                }
            ]
        },
        "createdAt": "2020-05-12T05:55:59+00:00",
        "invoices": []
    },
    "releaseNotifications": [
        {
            "uuid": "00000000-0000-0000-0000-000000000000",
            "name": "From Plan 1",
            "email": "from-plan1@typo3.com",
            "inherited": true,
            "owner": "user:max.muster",
            "accepted": false
        },
        {
            "uuid": "11111111-1111-1111-1111-111111111111",
            "name": "From Plan 2",
            "email": "from-plan2@typo3.com",
            "inherited": true,
            "owner": "user:max.muster",
            "accepted": true
        }
    ],
    "technicalContacts": [
        {
            "uuid": "00000000-0000-0000-0000-000000000000",
            "firstName": "From Plan 1",
            "lastName": "From Plan 1",
            "email": "from-plan-1@typo3.com",
            "accepted": false,
            "inherited": true,
            "username": "plan1_1"
        },
        {
            "uuid": "11111111-1111-1111-1111-111111111111",
            "firstName": "From Plan 2",
            "lastName": "From PLan 2",
            "email": "from-plan-2@example.com",
            "accepted": false,
            "inherited": true,
            "username": null
        }
    ],
    "owner": "user:max.muster",
    "ownerData": {
        "title": "Max Muster",
        "email": "max@example.com"
    },
    "title": "Single Plan 8.7 ELTS"
}
');
