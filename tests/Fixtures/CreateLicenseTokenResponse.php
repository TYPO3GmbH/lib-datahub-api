<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(201, ['content-type' => 'application/json', 'cache-control' => 'no-store'], '
{
  "token": "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJsaWNlbnNlIn0.c2lnbmF0dXJl",
  "expiresAt": "2027-09-28T00:00:00+00:00"
}
');
