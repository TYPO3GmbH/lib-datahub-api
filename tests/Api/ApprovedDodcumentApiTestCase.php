<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\ApprovedDocumentApi;
use T3G\DatahubApiLibrary\Entity\ApprovedDocument;

class ApprovedDodcumentApiTestCase extends AbstractApiTestCase
{
    public function testApproveDocument(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetApprovedDocumentResponse.php',
        ]);
        $response = (new ApprovedDocumentApi($this->getClient($handler)))
            ->approveDocument('oelie-boelie', $this->getTestApprovedDocument());
        self::assertEquals('foo', $response->getDocumentIdentifier());
        self::assertEquals('1.2.3', $response->getDocumentVersion());
        self::assertEquals('2020-02-26T00:00:00+00:00', $response->getApproveDate()->format(\DateTimeInterface::ATOM));
    }

    private function getTestApprovedDocument(): ApprovedDocument
    {
        return (new ApprovedDocument())
            ->setDocumentIdentifier('foo')
            ->setDocumentVersion('1.2.3');
    }
}
