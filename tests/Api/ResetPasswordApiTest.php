<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\PasswordResetApi;

class ResetPasswordApiTest extends AbstractApiTest
{
    public function testResetPassword(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new PasswordResetApi($this->getClient($handler));
        try {
            $api->requestPasswordReset('oelie-boelie');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        $this->assertFalse($anExceptionWasThrown);
    }
}
