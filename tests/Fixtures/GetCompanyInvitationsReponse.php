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
            "inviteCode": "00000000-0000-0000-0000-000000000000",
            "validUntil": "2020-07-07T10:35:01+00:00",
            "role": "EMPLOYEE",
            "username": "oelie_boelie",
            "email": "oelie@boelie.com"
        }
    ]
}

');
