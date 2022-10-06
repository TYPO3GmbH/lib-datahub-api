<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\MailAddressFilterApi;
use T3G\DatahubApiLibrary\Entity\MailAddressFilter;
use T3G\DatahubApiLibrary\Enum\MailAddressFilterType;

class MailAddressFilterApiTest extends AbstractApiTest
{
    public function testListMailAddressFilters(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ListMailAddressFiltersResponse.php',
        ]);
        $api = new MailAddressFilterApi($this->getClient($handler));
        $response = $api->getAllMailAddressFilters();
        self::assertCount(3, $response);
        self::assertEquals('de', $response[0]->getPattern());
        self::assertEquals('ALLOWED_TLD', $response[0]->getType());
    }

    public function testGetMailAddressFilter(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetMailAddressFilterResponse.php',
        ]);
        $api = new MailAddressFilterApi($this->getClient($handler));
        $entity = $api->getMailAddressFilter('00000000-0000-0000-0000-000000000000');
        self::assertEquals('de', $entity->getPattern());
        self::assertEquals('ALLOWED_TLD', $entity->getType());
    }

    public function testCreateMailAddressFilter(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetMailAddressFilterResponse.php',
        ]);
        $api = new MailAddressFilterApi($this->getClient($handler));
        $entity = $api->createMailAddressFilter($this->getTestMailAddressFilter());
        self::assertEquals('de', $entity->getPattern());
        self::assertEquals('ALLOWED_TLD', $entity->getType());
    }

    public function testUpdateMailAddressFilter(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetMailAddressFilterResponse.php',
        ]);
        $api = new MailAddressFilterApi($this->getClient($handler));
        $entity = $api->updateMailAddressFilter('00000000-0000-0000-0000-000000000000', $this->getTestMailAddressFilter());
        self::assertEquals('de', $entity->getPattern());
        self::assertEquals('ALLOWED_TLD', $entity->getType());
    }

    public function testDeleteMailAddressFilter(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new MailAddressFilterApi($this->getClient($handler));
        try {
            $api->deleteMailAddressFilter('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        self::assertFalse($anExceptionWasThrown);
    }

    private function getTestMailAddressFilter(): MailAddressFilter
    {
        return (new MailAddressFilter())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setType(MailAddressFilterType::ALLOWED_TLD)
            ->setPattern('.de');
    }
}
