<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
[
  {
    "version": "8.7",
    "vendor": "TYPO3GmbH",
    "repository": "elts-8.7-release",
    "serviceDesk": "https:\/\/support.typo3.com",
    "runtimes": {
      "1-1": {
        "identifier": "1-1",
        "validFrom": "2020-04-01T00:00:00+00:00",
        "validTo": "2021-03-31T00:00:00+00:00"
      },
      "1-2": {
        "identifier": "1-2",
        "validFrom": "2020-04-01T00:00:00+00:00",
        "validTo": "2022-03-31T00:00:00+00:00"
      },
      "1-3": {
        "identifier": "1-3",
        "validFrom": "2020-04-01T00:00:00+00:00",
        "validTo": "2023-03-31T00:00:00+00:00"
      },
      "2-2": {
        "identifier": "2-2",
        "validFrom": "2021-04-01T00:00:00+00:00",
        "validTo": "2022-03-31T00:00:00+00:00"
      },
      "2-3": {
        "identifier": "2-3",
        "validFrom": "2021-04-01T00:00:00+00:00",
        "validTo": "2023-03-31T00:00:00+00:00"
      },
      "3-3": {
        "identifier": "3-3",
        "validFrom": "2022-04-01T00:00:00+00:00",
        "validTo": "2023-03-31T00:00:00+00:00"
      }
    }
  }
]
');
