<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\LinkApi;
use T3G\DatahubApiLibrary\Entity\Link;

class LinkApiTest extends AbstractApiTestCase
{
    public function testGetLink(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetLinkResponse.php',
        ]);
        $api = new LinkApi($this->getClient($handler));
        $response = $api->getLink('00000000-0000-0000-0000-000000000000');
        self::assertEquals('github', $response->getType());
        self::assertEquals('oelie-boelie', $response->getValue());
        self::assertEquals('false', $response->isHighlight());
    }

    public function testCreateLink(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetLinkResponse.php',
        ]);
        $api = new LinkApi($this->getClient($handler));
        $response = $api->createLink('oelie-boelie', $this->getTestLink());
        self::assertEquals('github', $response->getType());
        self::assertEquals('oelie-boelie', $response->getValue());
        self::assertTrue($response->isHighlight());
    }

    public function testUpdateLink(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetLinkResponse.php',
        ]);
        $api = new LinkApi($this->getClient($handler));
        $response = $api->updateLink('00000000-0000-0000-0000-000000000000', $this->getTestLink());
        self::assertEquals('github', $response->getType());
        self::assertEquals('oelie-boelie', $response->getValue());
        self::assertTrue($response->isHighlight());
    }

    public function testDeleteLink(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);
        $api = new LinkApi($this->getClient($handler));
        try {
            $api->deleteLink('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception) {
            $anExceptionWasThrown = true;
        }
        self::assertFalse($anExceptionWasThrown);
    }

    private function getTestLink(): Link
    {
        return (new Link())
            ->setValue('https://github.com/oelie-boelie')
            ->setType('github')
            ->setHighlight(true);
    }
}
