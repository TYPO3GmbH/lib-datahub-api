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
  "uuid": "dd1183cd-b4d1-402e-a50b-17cc0c72acd9",
  "createdAt": "2021-04-12T11:16:12+00:00",
  "payload": [],
  "offerNumber": "TO-1234",
  "cartIdentifier": "any-identifier",
  "validUntil": "2021-05-11T23:59:59+00:00",
  "total": 0
}
');
