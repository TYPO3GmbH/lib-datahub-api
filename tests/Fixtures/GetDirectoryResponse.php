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
		"type": "dir",
		"name": "exam"
	},
	{
		"type": "file",
		"name": "legal-notice.md"
	},
	{
		"type": "file",
		"name": "payment-and-shipping.md"
	},
	{
		"type": "file",
		"name": "privacy-policy.md"
	},
	{
		"type": "file",
		"name": "right-of-revocation.md"
	},
	{
		"type": "file",
		"name": "terms-conditions.md"
	}
]
');
