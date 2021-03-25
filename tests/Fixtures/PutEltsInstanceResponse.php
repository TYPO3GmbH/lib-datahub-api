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
    "eltsPlan": {
        "uuid": "00000000-0000-0000-0000-000000000000",
        "owner": "user:max.muster",
        "version": "8.7",
        "type": "single",
        "runtime": "1-3",
        "validFrom": "2020-04-01T00:00:00+00:00",
        "validTo": "2023-03-31T00:00:00+00:00",
        "order": [],
        "licenses": 1,
        "releaseNotifications": [],
        "technicalContacts": []
    },
    "releaseNotifications": [
        {
            "uuid": "22222222-2222-2222-2222-222222222222",
            "name": "From Instance 1",
            "email": "from-instance1@typo3.com",
            "inherited": false,
            "owner": "user:max.muster",
            "accepted": true
        }
    ],
    "technicalContacts": [
        {
            "uuid": "c15e1db3-d663-4da0-bf2e-bf656753c900",
            "username": "bazbencer",
            "firstName": "Baz",
            "lastName": "Bencer",
            "email": "foo@bar.dev"
        }
    ],
    "owner": "user:max.muster"
}
');
