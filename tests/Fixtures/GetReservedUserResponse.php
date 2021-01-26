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
    "username": "serious.spam",
    "email": "spammer@spam.org",
    "deleteDate": "2020-01-10T00:00:00+00:00",
    "otrsIssue": "123",
    "deletedBy": "Admin",
    "gitlabIssue": "234",
    "comment": "Is a spammer",
    "status": "DELETED"
}
');
