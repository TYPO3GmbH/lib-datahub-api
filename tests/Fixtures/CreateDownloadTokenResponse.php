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
  "token": "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJkb3dubG9hZCJ9.c2lnbmF0dXJl",
  "expiresAt": "2026-09-23T12:00:30+00:00"
}
');
