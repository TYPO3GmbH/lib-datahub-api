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
            "username": "max.muster",
            "email": "max@example.com"
        },
        {
            "username": "marion.malle",
            "email": "marion@example.com"
        },
        {
            "username": "fritz.fuscher",
            "email": "fritz@example.com"
        },
        {
            "username": "karla.kolumna",
            "email": "karla@example.com"
        }
    ],
    "length": 4,
    "type": "App\\\\Dto\\\\EntityList\\\\UserEmailList"
}
');
