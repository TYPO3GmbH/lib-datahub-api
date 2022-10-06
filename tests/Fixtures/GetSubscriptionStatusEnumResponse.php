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
  "data": {
    "active": "Active subscription",
    "past_due": "Past due payment",
    "unpaid": "Unpaid payment",
    "canceled": "Canceled payment",
    "incomplete": "Incomplete payment",
    "incomplete_expired": "Incomplete payment expired",
    "trialing": "Trialing payment"
  }
}
');
