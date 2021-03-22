<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
{
    "uuid": "d209090d-be9e-4034-82e8-7a7ebb5b776c",
    "firstName": "John",
    "lastName": "Doe",
    "email": "johndoe@example.com"
}
');
