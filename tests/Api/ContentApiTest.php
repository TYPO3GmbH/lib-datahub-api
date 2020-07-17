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
}
