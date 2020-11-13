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
      "source": "App\\\\Service\\\\CompanyPreDeletionCheck\\\\AddressesPreCheck",
      "type": "info",
      "result": true,
      "additionalData": {
        "amountOfAddresses": 0
      }
    },
    {
      "source": "App\\\\Service\\\\CompanyPreDeletionCheck\\\\MembersPreCheck",
      "type": "blocking",
      "result": false,
      "additionalData": {
        "amountOfEmployees": 1,
        "amountOfInvitations": 0
      }
    }
  ],
  "length": 2,
  "type": "App\\\\Entity\\\\CompanyPreDeletionCheckList"
}
');
