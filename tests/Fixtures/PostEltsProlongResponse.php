<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
{
  "uuid": "11111111-1111-1111-1111-111111111111",
  "version": "8.7",
  "type": "single",
  "runtime": "2-2",
  "validFrom": "2021-04-01T00:00:00+00:00",
  "validTo": "2022-03-31T00:00:00+00:00",
  "licenses": 1,
  "order": null,
  "owner": "user:oelie.boelie",
  "title": "Single Plan 8.7 ELTS"
}
');
