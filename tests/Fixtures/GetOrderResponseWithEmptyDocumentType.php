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
      "orderNumber": "A12345",
      "payload": {"items": [ {"foo": "bar"} ]},
      "uuid": "00000000-0000-0000-0000-000000000000",
      "createdAt": "2020-01-10T00:00:00+00:00",
      "invoices": [
        {
            "title": "Test-Title",
            "number": "I12345",
            "identifier": "in_1234",
            "link": "https://dienmam.com/invoice",
            "date": "2020-01-10T00:00:00+00:00",
            "documentType": ""
        }
      ]
    }
');
