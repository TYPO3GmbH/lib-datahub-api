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
  "type": "TCCE",
  "version": "10.4",
  "auditType": "PRESENCE",
  "user": {
    "username": "oelie-boelie"
  },
  "status": "UNKNOWN",
  "examLocation": "online",
  "examDate": "2020-06-02T00:00:00+00:00",
  "ndaSigned": true,
  "rulesAccepted": true,
  "proctoringLink": null,
  "examUrl": "https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000",
  "examTestResult": "NO_RESULT",
  "proctoringStatus": "pending"
}
');
