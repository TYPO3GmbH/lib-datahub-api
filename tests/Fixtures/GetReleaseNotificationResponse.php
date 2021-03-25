<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
{
    "uuid": "00000000-0000-0000-0000-000000000000",
    "name": "From Plan 1",
    "email": "from-plan1@typo3.com",
    "eltsPlan": {
        "uuid": "00000000-0000-0000-0000-000000000000",
        "owner": "user:max.muster",
        "version": "8.7",
        "type": "single",
        "runtime": "1-3"
    },
    "eltsInstance": null,
    "inherited": true,
    "owner": "user:max.muster",
    "accepted": false
}

');
