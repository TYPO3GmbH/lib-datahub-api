<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\ContentApi;

class ContentApiTest extends AbstractApiTest
{
    public function testGetContent(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetContentResponse.php'
        ]);
        $api = new ContentApi($this->getClient($handler));
        $response = $api->getDocument('test-document');
        $this->assertEquals('<h1>Hello World!</h1>', $response->getContent());
        $this->assertEquals('html', $response->getFormat());
        $this->assertEquals('test-document', $response->getIdentifier());
        $this->assertEquals('1.0.0', $response->getVersion());
    }

    public function testGetFAQ(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetFAQResponse.php'
        ]);
        $api = new ContentApi($this->getClient($handler));
        $response = $api->getFAQ('test-faq');
        $this->assertEquals('json', $response->getFormat());
        $this->assertEquals('test-faq', $response->getIdentifier());
        $this->assertEquals('latest', $response->getVersion());
        $content = $response->getContent();
        $contentData = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals('ELTS', $contentData['label']);
        $this->assertEquals('elts', $contentData['identifier']);
        $this->assertEquals('actions-shield', $contentData['icon']);
        $this->assertEquals('Test with ELTS', $contentData['description']);
        $this->assertCount(1, $contentData['sections']);
        $this->assertEquals('Common', $contentData['sections'][0]['label']);
        $this->assertEquals('common', $contentData['sections'][0]['identifier']);
        $this->assertCount(1, $contentData['sections'][0]['questions']);
        $this->assertEquals('What??', $contentData['sections'][0]['questions'][0]['label']);
        $this->assertEquals('what', $contentData['sections'][0]['questions'][0]['identifier']);
        $this->assertCount(1, $contentData['sections'][0]['questions'][0]['blocks']);
        $this->assertEquals('<p>Whaaaat?</p>', $contentData['sections'][0]['questions'][0]['blocks'][0]['description']);
        $this->assertEquals(null, $contentData['sections'][0]['questions'][0]['blocks'][0]['image_url']);
        $this->assertEquals('left', $contentData['sections'][0]['questions'][0]['blocks'][0]['image_position']);
    }
}
