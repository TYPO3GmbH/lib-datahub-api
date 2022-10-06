<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

$json = <<<JSON
{
    "meta": {
        "totalRecordCount": 1
    },
    "links": {
        "first": "\/order\/search\/?page[limit]=1",
        "prev": null,
        "next": "\/order\/search\/?page[limit]=1&page[offset]=1"
    },
    "data": [
        {
            "uuid": "00000000-0000-0000-0000-000000000000",
            "orderNumber": "G12345",
            "payload": {
                "items": [
                    {
                        "title": "T-Shirt",
                        "quantity": 1
                    }
                ]
            },
            "createdAt": "2020-01-10T00:00:00+00:00",
            "invoices": []
        }
    ]
}
JSON;

return new Response(200, ['content-type' => 'application/json'], $json);
