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
    "uuid": "1539a7c7-3d09-42c3-9a22-e84e57bdd86a",
    "name": "Markus Miller",
    "email": "markus.miller@typo3.com",
    "inherited": false,
    "owner": "user:max.muster",
    "eltsPlan": null,
    "eltsInstance": {
        "uuid": "00000000-0000-0000-0000-000000000000",
        "name": "Single instance",
        "owner": "user:max.muster"
    },
    "accepted": false
}
');
