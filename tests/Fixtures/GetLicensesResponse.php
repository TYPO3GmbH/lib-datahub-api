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
  "length": 2,
  "entities": [
    {
      "uuid": "5f0c4b8e-3d3a-4c1e-9b7a-1e2f3a4b5c6d",
      "type": "SUITE",
      "status": "VALID",
      "createdAt": "2026-09-01T10:00:00+00:00",
      "validUntil": "2027-09-01T00:00:00+00:00",
      "history": null,
      "currentJti": "0b4ce2c8-0d8b-4b8b-8d5a-3b0c5b6c4a2f"
    },
    {
      "uuid": "8a1d2e3f-4b5c-4d6e-8f7a-9b0c1d2e3f4a",
      "type": "ELTS",
      "status": "INVALID",
      "createdAt": "2026-03-01T10:00:00+00:00",
      "validUntil": "2026-09-01T00:00:00+00:00",
      "history": "Set to invalid",
      "currentJti": null
    }
  ],
  "type": "App\\\\Entity\\\\LicenseList"
}
');
