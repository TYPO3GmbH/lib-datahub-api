<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
[
    {
        "role": "OWNER",
        "joinedAt": "2021-02-26T00:00:00+00:00",
        "leftAt": null,
        "uuid": "00000000-0000-0000-0000-000000000000",
        "company": {
            "uuid": "00000000-0000-0000-0000-000000000000",
            "companyType": "UNIVERSITY",
            "title": "Dien Mam International",
            "email": "rotop@dienmam.nl",
            "vatId": "NL123456789B01"
        }
    }
]
');
