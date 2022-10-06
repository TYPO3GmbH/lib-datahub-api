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
  "validUntil": "2021-02-26T00:00:00+00:00",
  "inviteCode": "abcd",
  "role": "EMPLOYEE"
}
');
