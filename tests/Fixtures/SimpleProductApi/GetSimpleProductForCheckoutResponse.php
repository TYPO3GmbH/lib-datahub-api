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
    "product": {
        "id": "prod_King",
        "name": "King of the Association"
    },
    "prices": {
        "price_King": {
            "id": "price_King",
            "unit_amount": 4200
        }
    },
    "discountedPrices": {
        "price_King": 900
    },
    "account": "acct_testaccount"
}
');
