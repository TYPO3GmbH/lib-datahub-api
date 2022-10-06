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
            "type": "TCCC",
            "version": "10.4",
            "examLocation": "Certifuncation",
            "examDate": "2020-01-10T00:00:00+00:00",
            "examTestResult": "PASSED",
            "auditType": "PRESENCE",
            "status": "PREPARATION_REQUIRED"
        }
    ],
    "length": 1,
    "type": "App\\\\Entity\\\\CertificationList"
}
');
