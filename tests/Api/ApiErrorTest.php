<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\CompanyApi;
use T3G\DatahubApiLibrary\Api\UserApi;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;

class ApiErrorTest extends AbstractApiTest
{
    public function testErrorWithNoBody(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NotFoundResponse.php'
        ]);
        $api = new UserApi($this->getClient($handler));
        $this->expectException(DatahubResponseException::class);
        $this->expectExceptionMessage('Response contained invalid JSON');
        $api->getUser('oelie-boelie');
    }

    public function testErrorWithErrorMessage(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ForbiddenWithErrorResponse.php'
        ]);
        $api = new UserApi($this->getClient($handler));
        $this->expectException(DatahubResponseException::class);
        $this->expectExceptionMessage('Forbidden: You shall not pass');
        $api->getUser('oelie-boelie');
    }

    public function testUuidValidation(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetConfirmCompanyInviteResponse.php'
        ]);
        $api = new CompanyApi($this->getClient($handler));
        $response = $api->confirmEmployeeInvitation('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('oelie-boelie', $response->getUser()->getUsername());
        $this->assertEquals('oelie@boelie.nl', $response->getUser()->getPrimaryEmail());
        $this->assertEquals('EMPLOYEE', $response->getRole());

        $this->expectException(InvalidUuidException::class);
        $api->confirmEmployeeInvitation('not-a-uuid');
    }

    public function testErrorWhenNonJsonContentTypeHeader(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NonJsonContentTypeHeaderInResponse.php'
        ]);
        $api = new UserApi($this->getClient($handler));
        $this->expectException(DatahubResponseException::class);
        $api->getUser('oelie-boelie');
    }
}
