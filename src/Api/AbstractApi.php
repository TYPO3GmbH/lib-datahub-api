<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\UriInterface;
use T3G\DatahubApiLibrary\Client\DataHubClient;

abstract class AbstractApi
{
    protected DataHubClient $client;

    public function __construct(DataHubClient $client)
    {
        $this->client = $client;
    }

    protected static function uri(string $path = ''): UriInterface
    {
        return new Uri($path);
    }
}
