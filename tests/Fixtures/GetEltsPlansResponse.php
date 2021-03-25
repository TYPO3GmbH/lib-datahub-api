<?php declare(strict_types=1);

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
            "uuid": "11111111-1111-1111-1111-111111111111",
            "version": "8.7",
            "type": "agency",
            "runtime": "2-2",
            "validFrom": "2021-04-01T00:00:00+00:00",
            "validTo": "2022-03-31T00:00:00+00:00",
            "instances": [
                {
                    "uuid": "11111111-1111-1111-1111-111111111111",
                    "name": "Agency instance 1",
                    "releaseNotifications": [
                        {
                            "uuid": "33333333-3333-3333-3333-333333333333",
                            "name": "From Plan 2.1",
                            "email": "from-plan1@typo3.com",
                            "inherited": true,
                            "owner": "organization:00000000-0000-0000-0000-000000000000",
                            "accepted": false
                        },
                        {
                            "uuid": "44444444-4444-4444-4444-444444444444",
                            "name": "From Plan 2.2",
                            "email": "from-plan2@typo3.com",
                            "inherited": true,
                            "owner": "organization:00000000-0000-0000-0000-000000000000",
                            "accepted": true
                        },
                        {
                            "uuid": "55555555-5555-5555-5555-555555555555",
                            "name": "From Instance 2.1",
                            "email": "from-instance1@typo3.com",
                            "inherited": false,
                            "owner": "organization:00000000-0000-0000-0000-000000000000",
                            "accepted": true
                        }
                    ],
                    "technicalContacts": [
                        {
                            "uuid": "44444444-4444-4444-4444-444444444444",
                            "firstName": "From Plan 1",
                            "lastName": "From Plan 1",
                            "email": "from-plan-1@typo3.com",
                            "accepted": false,
                            "inherited": true,
                            "username": "plan1_1"
                        },
                        {
                            "uuid": "55555555-5555-5555-5555-555555555555",
                            "firstName": "From Plan 2.2",
                            "lastName": "From PLan 2.2",
                            "email": "from-plan-2@example.com",
                            "accepted": false,
                            "inherited": true,
                            "username": null
                        },
                        {
                            "uuid": "66666666-6666-6666-6666-666666666666",
                            "firstName": "From Instance 1",
                            "lastName": "From Instance 1",
                            "email": "from-instance-1@typo3.com",
                            "accepted": false,
                            "inherited": false,
                            "username": "instance1_1"
                        },
                        {
                            "uuid": "77777777-7777-7777-7777-777777777777",
                            "firstName": "From Instance 2.2",
                            "lastName": "From Instance 2.2",
                            "email": "from-Instance-2@example.com",
                            "accepted": false,
                            "inherited": false,
                            "username": null
                        }
                    ],
                    "owner": "organization:00000000-0000-0000-0000-000000000000"
                },
                {
                    "uuid": "22222222-2222-2222-2222-222222222222",
                    "name": "Agency instance 2",
                    "releaseNotifications": [
                        {
                            "uuid": "33333333-3333-3333-3333-333333333333",
                            "name": "From Plan 2.1",
                            "email": "from-plan1@typo3.com",
                            "inherited": true,
                            "owner": "organization:00000000-0000-0000-0000-000000000000",
                            "accepted": false
                        },
                        {
                            "uuid": "44444444-4444-4444-4444-444444444444",
                            "name": "From Plan 2.2",
                            "email": "from-plan2@typo3.com",
                            "inherited": true,
                            "owner": "organization:00000000-0000-0000-0000-000000000000",
                            "accepted": true
                        }
                    ],
                    "technicalContacts": [
                        {
                            "uuid": "44444444-4444-4444-4444-444444444444",
                            "firstName": "From Plan 1",
                            "lastName": "From Plan 1",
                            "email": "from-plan-1@typo3.com",
                            "accepted": false,
                            "inherited": true,
                            "username": "plan1_1"
                        },
                        {
                            "uuid": "55555555-5555-5555-5555-555555555555",
                            "firstName": "From Plan 2.2",
                            "lastName": "From PLan 2.2",
                            "email": "from-plan-2@example.com",
                            "accepted": false,
                            "inherited": true,
                            "username": null
                        }
                    ],
                    "owner": "organization:00000000-0000-0000-0000-000000000000"
                }
            ],
            "licenses": null,
            "order": {
                "uuid": "1861f4cc-a87a-46c0-bb5a-3529a54dad32",
                "orderNumber": "GELTS234",
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
                    "uuid": "33333333-3333-3333-3333-333333333333",
                    "name": "From Plan 2.1",
                    "email": "from-plan1@typo3.com",
                    "inherited": true,
                    "owner": "organization:00000000-0000-0000-0000-000000000000",
                    "accepted": false
                },
                {
                    "uuid": "44444444-4444-4444-4444-444444444444",
                    "name": "From Plan 2.2",
                    "email": "from-plan2@typo3.com",
                    "inherited": true,
                    "owner": "organization:00000000-0000-0000-0000-000000000000",
                    "accepted": true
                }
            ],
            "technicalContacts": [
                {
                    "uuid": "44444444-4444-4444-4444-444444444444",
                    "firstName": "From Plan 1",
                    "lastName": "From Plan 1",
                    "email": "from-plan-1@typo3.com",
                    "accepted": false,
                    "inherited": true,
                    "username": "plan1_1"
                },
                {
                    "uuid": "55555555-5555-5555-5555-555555555555",
                    "firstName": "From Plan 2.2",
                    "lastName": "From PLan 2.2",
                    "email": "from-plan-2@example.com",
                    "accepted": false,
                    "inherited": true,
                    "username": null
                }
            ],
            "owner": "organization:00000000-0000-0000-0000-000000000000",
            "title": "Agency Plan 8.7 ELTS"
        },
        {
            "uuid": "22222222-2222-2222-2222-222222222222",
            "version": "8.7",
            "type": "pro",
            "runtime": "2-3",
            "validFrom": "2021-04-01T00:00:00+00:00",
            "validTo": "2023-03-31T00:00:00+00:00",
            "instances": [],
            "licenses": 5,
            "order": null,
            "releaseNotifications": [],
            "technicalContacts": [],
            "owner": "organization:00000000-0000-0000-0000-000000000000",
            "title": "Pro Plan 8.7 ELTS"
        }
    ],
    "length": 2,
    "type": "App\\\\Entity\\\\EltsPlanList"
}
');
