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
  "username": "oelie-boelie",
  "email": "oelie@boelie.nl",
  "firstName": "Oelie",
  "lastName": "Boelie",
  "registrationCode": "a9fde411-e46f-4fca-80f4-347bf3b57ca3",
  "validUntil": "2020-04-13T14:24:21+00:00",
  "location": "lidl"
}
');
