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
  "token": "aaabbbccc",
  "createdAt": "2020-01-10T00:00:00+00:00",
  "name": "Test",
  "description": "Test-Description",
  "user": {
    "username": "oelie",
    "firstName": "Oelie",
    "lastName": "Boelie",
    "status": {
      "membership": "COMMUNITY"
    }
  }
}
');
