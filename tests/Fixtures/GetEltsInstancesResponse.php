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
            "name": "Agency instance 1",
            "eltsPlan": {
                "uuid": "11111111-1111-1111-1111-111111111111",
                "owner": "organization:00000000-0000-0000-0000-000000000000",
                "version": "8.7",
                "type": "agency",
                "runtime": "2-2",
                "validFrom": "2021-04-01T00:00:00+00:00",
                "validTo": "2022-03-31T00:00:00+00:00",
                "order": [],
                "licenses": null,
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
                ]
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
        }
    ],
    "length": 1,
    "type": "App\\\\Entity\\\\EltsInstanceList"
}

');
