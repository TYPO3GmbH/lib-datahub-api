<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(
    200,
    ['content-type' => 'application/json'],
    '
{
    "role": "MANAGER",
    "joinedAt": "2021-02-26T00:00:00+00:00",
    "leftAt": null,
    "uuid": "aaa-bbb",
    "user": {
        "username": "oelie-boelie",
        "email": "oelie@boelie.nl",
        "firstName": "Oelie",
        "lastName": "Boelie",
        "emailAddresses": [
            {
                "uuid": "55555555-5555-5555-5555-555555555555",
                "email": "oelie@boelie.nl",
                "type": 273,
                "optIn": "2020-01-01T00:00:00+00:00"
            }
        ]
    }
}
'
);
