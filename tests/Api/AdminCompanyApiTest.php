<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\AdminCompanyApi;
use T3G\DatahubApiLibrary\Dto\Admin\CreateCompanyDto;
use T3G\DatahubApiLibrary\Dto\Admin\UpdateCompanyDto;
use T3G\DatahubApiLibrary\Enum\CompanyType;

class AdminCompanyApiTest extends AbstractApiTestCase
{
    public function testCreateCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php',
        ]);
        $api = new AdminCompanyApi($this->getClient($handler));

        $dto = new CreateCompanyDto();
        $dto->title = 'Test Company';
        $dto->companyType = CompanyType::AGENCY;

        $response = $api->createCompany($dto);
        self::assertEquals(CompanyType::AGENCY, $response->getCompanyType());
        self::assertEquals($dto->title, $response->getTitle());
        self::assertEquals($dto->companyType, $response->getCompanyType());
    }

    public function testUpdateCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCompanyResponse.php',
        ]);
        $api = new AdminCompanyApi($this->getClient($handler));

        $dto = new UpdateCompanyDto();
        $dto->title = 'Test Company';
        $dto->companyType = CompanyType::AGENCY;
        $dto->vatId = 'DE 123 456 789';
        $dto->domain = 'typo3.com';

        $response = $api->updateCompany('00000000-0000-0000-0000-000000000000', $dto);
        self::assertEquals($dto->title, $response->getTitle());
        self::assertEquals($dto->companyType, $response->getCompanyType());
        self::assertEquals($dto->vatId, $response->getVatId());
        self::assertEquals($dto->domain, $response->getDomain());
    }
}
