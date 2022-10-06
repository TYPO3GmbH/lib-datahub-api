<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\ContentApi;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class ContentApiTest extends AbstractApiTest
{
    public function testGetContent(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetContentResponse.php',
        ]);
        $api = new ContentApi($this->getClient($handler));
        $response = $api->getDocument('test-document');
        self::assertEquals('<h1>Hello World!</h1>', $response->getContent());
        self::assertEquals('html', $response->getFormat());
        self::assertEquals('test-document', $response->getIdentifier());
        self::assertEquals('1.0.0', $response->getVersion());
    }

    public function testGetFAQ(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetFAQResponse.php',
        ]);
        $api = new ContentApi($this->getClient($handler));
        $response = $api->getFAQ('test-faq');
        self::assertEquals('json', $response->getFormat());
        self::assertEquals('test-faq', $response->getIdentifier());
        self::assertEquals('latest', $response->getVersion());
        $content = $response->getContent();
        $contentData = JsonUtility::decode($content);
        self::assertEquals('ELTS', $contentData['label']);
        self::assertEquals('elts', $contentData['identifier']);
        self::assertEquals('actions-shield', $contentData['icon']);
        self::assertEquals('Test with ELTS', $contentData['description']);
        self::assertCount(1, $contentData['sections']);
        self::assertEquals('Common', $contentData['sections'][0]['label']);
        self::assertEquals('common', $contentData['sections'][0]['identifier']);
        self::assertCount(1, $contentData['sections'][0]['questions']);
        self::assertEquals('What??', $contentData['sections'][0]['questions'][0]['label']);
        self::assertEquals('what', $contentData['sections'][0]['questions'][0]['identifier']);
        self::assertCount(1, $contentData['sections'][0]['questions'][0]['blocks']);
        self::assertEquals('<p>Whaaaat?</p>', $contentData['sections'][0]['questions'][0]['blocks'][0]['description']);
        self::assertNull($contentData['sections'][0]['questions'][0]['blocks'][0]['image_url']);
        self::assertEquals('left', $contentData['sections'][0]['questions'][0]['blocks'][0]['image_position']);
    }

    public function testGetDirectory(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetDirectoryResponse.php',
        ]);
        $api = new ContentApi($this->getClient($handler));
        $response = $api->getDirectory('foo', 'task/bar');
        self::assertIsArray($response);
        self::assertCount(1, array_filter($response, static fn ($item) => 'dir' === $item['type']));
        self::assertCount(5, array_filter($response, static fn ($item) => 'file' === $item['type']));
    }
}
