<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
{
    "uuid": "1539a7c7-3d09-42c3-9a22-e84e57bdd86a",
    "firstName": "Markus",
    "lastName": "Miller",
    "email": "markus.miller@typo3.com",
    "username": null
}
');
