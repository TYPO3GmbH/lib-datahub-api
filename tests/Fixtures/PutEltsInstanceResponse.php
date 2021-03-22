<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
{
    "uuid": "c5c729b5-e5c3-42f3-89ce-caa07e670fc2",
    "name": "Wololo Ltd.",
    "technicalContacts": [
        {
            "uuid": "c15e1db3-d663-4da0-bf2e-bf656753c900",
            "username": "bazbencer",
            "firstName": "Baz",
            "lastName": "Bencer",
            "email": "foo@bar.dev"
        }
    ]
}
');
