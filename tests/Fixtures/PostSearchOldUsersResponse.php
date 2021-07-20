<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use GuzzleHttp\Psr7\Response;

return new Response(200, ['content-type' => 'application/json'], '
{
  "entities": [
    {
      "username": "neoblack",
      "email": "neoblack@typo3.org",
      "deleteDate": "2020-01-10T00:00:00+00:00",
      "otrsIssue": "123",
      "comment": "Is a spammer"
    },
    {
      "username": "blackneo",
      "email": "blackneo@typo3.org",
      "deleteDate": "2020-01-10T00:00:00+00:00",
      "otrsIssue": "123",
      "comment": "Is a spammer"
    },
    {
      "username": "fooneobar",
      "email": "fooneobar@typo3.org",
      "deleteDate": "2020-01-10T00:00:00+00:00",
      "otrsIssue": "123",
      "comment": "Is a spammer"
    }
  ],
  "length": 3,
  "type": "App\\\Entity\\\ReservedUserList"
}
');
