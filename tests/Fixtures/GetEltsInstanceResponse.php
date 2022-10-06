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
    "name": "Single instance",
    "eltsPlan": {
        "uuid": "00000000-0000-0000-0000-000000000000",
        "owner": "user:max.muster",
        "ownerData": {
            "title": "Max Muster",
            "email": "max@example.com"
        },
        "version": "8.7",
        "type": "single",
        "runtime": "1-3",
        "validFrom": "2020-04-01T00:00:00+00:00",
        "validTo": "2023-03-31T00:00:00+00:00",
        "order": [],
        "licenses": 1,
        "releaseNotifications": [],
        "technicalContacts": []
    },
    "releaseNotifications": [
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
            "uuid": "22222222-2222-2222-2222-222222222222",
            "firstName": "From Instance 1",
            "lastName": "From Instance 1",
            "email": "from-instance-1@typo3.com",
            "accepted": false,
            "inherited": false,
            "username": "instance1_1"
        }
    ],
    "owner": "user:max.muster",
    "ownerData": {
        "title": "Max Muster",
        "email": "max@example.com"
    }
}
');
