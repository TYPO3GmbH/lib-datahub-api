<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Http\Factory\Guzzle\RequestFactory;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Client\DataHubClient;

abstract class AbstractApiTest extends TestCase
{
    /**
     * @param MockHandler|HandlerStack $handler
     *
     * @return DataHubClient
     *
     * @throws \Exception
     */
    protected function getClient($handler): DataHubClient
    {
        $client = new Client(['handler' => $handler]);
        $logger = new Logger('testing-channel');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../test.log', Logger::DEBUG));

        return new DataHubClient($client, new RequestFactory(), 'SomeToken', 'https://datahub.typo3.com/api', $logger);
    }
}
