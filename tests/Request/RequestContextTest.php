<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Request;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Request\RequestContext;

final class RequestContextTest extends TestCase
{
    public function testFromCombinedIdentifierCreatesContext(): void
    {
        $type = 'personal';
        $identifier = 'oelie.boelie';

        $requestContext = RequestContext::fromCombinedIdentifier($type . ':' . $identifier);
        self::assertSame($type, $requestContext->type);
        self::assertSame($identifier, $requestContext->identifier);
    }

    public function testContextArrayIsCraftedCorrectly(): void
    {
        $type = 'personal';
        $identifier = 'oelie.boelie';

        $requestContext = RequestContext::fromCombinedIdentifier($type . ':' . $identifier)->toArray();
        self::assertArrayHasKey('context', $requestContext);
        self::assertIsArray($requestContext['context']);
        self::assertArrayHasKey('type', $requestContext['context']);
        self::assertArrayHasKey('identifier', $requestContext['context']);
        self::assertSame($type, $requestContext['context']['type']);
        self::assertSame($identifier, $requestContext['context']['identifier']);
    }
}
