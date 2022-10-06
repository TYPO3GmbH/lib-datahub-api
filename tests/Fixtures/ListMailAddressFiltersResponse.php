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
    "entities": [
        {
            "uuid": "00000000-0000-0000-0000-000000000000",
            "pattern": "de",
            "type": "ALLOWED_TLD"
        },
        {
            "uuid": "00000000-0000-0000-0000-000000000002",
            "pattern": "domain.de",
            "type": "DENIED_DOMAIN"
        },
        {
            "uuid": "00000000-0000-0000-0000-000000000003",
            "pattern": "domain.in",
            "type": "DENIED_DOMAIN"
        }
    ]
}
');
