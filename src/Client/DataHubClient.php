<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerInterface;
use Sunrise\Stream\StreamFactory;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;

class DataHubClient
{
    private ClientInterface $httpClient;

    private RequestFactoryInterface $requestFactory;

    private ?string $token;

    private string $baseUri;

    private ?LoggerInterface $logger;

    public function __construct(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        ?string $token = null,
        string $baseUri = 'https://datahub.typo3.com/api',
        LoggerInterface $logger = null
    ) {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->token = $token;
        $this->baseUri = $baseUri;
        $this->logger = $logger;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function request(string $method, UriInterface $endpoint, string $body = null): ResponseInterface
    {
        $request = $this->requestFactory->createRequest($method, rtrim($this->baseUri, '/') . '/' . ltrim($endpoint->__toString(), '/'));
        if (null !== $this->token && !$request->hasHeader('Authorization')) {
            $request = $request->withAddedHeader('Authorization', 'Bearer ' . $this->token);
        }
        if (!$request->hasHeader('Content-Type')) {
            $request = $request->withAddedHeader('Content-Type', 'application/json');
        }
        if (null !== $body) {
            $stream = (new StreamFactory())->createStream($body);
            $request = $request->withBody($stream);
        }

        $response = $this->httpClient->sendRequest($request);

        if ($this->logger) {
            $this->logger->debug('[Datahub API Client] Datahub request', $this->getLogContext($request, $response));
            $response->getBody()->seek(0);
        }

        $code = $response->getStatusCode();
        if ((200 > $code || 400 <= $code) || ($response->hasHeader('content-type') && empty($this->substrArray('application/json', $response->getHeader('content-type'))))) {
            if ($this->logger) {
                $this->logger->error('[Datahub API Client] Error carrying out Datahub request', $this->getLogContext($request, $response));
                $response->getBody()->seek(0);
            }
            throw new DatahubResponseException($request, $response);
        }

        return $response;
    }

    private function substrArray(string $needle, array $haystack, bool $caseInsensitive = false): array
    {
        return array_filter($haystack, static function ($item) use ($needle, $caseInsensitive) {
            return false !== ($caseInsensitive ? stripos($item, $needle) : strpos($item, $needle));
        });
    }

    private function getLogContext(RequestInterface $request, ResponseInterface $response): array
    {
        return [
            'request' => [
                'method' => $request->getMethod(),
                'endpoint' => $request->getUri(),
                'body' => (string)$request->getBody(),
                'base_uri' => $this->baseUri,
                'headers' => $request->getHeaders(),
            ],
            'response' => [
                'status_code' => $response->getStatusCode(),
                'headers' => $response->getHeaders(),
                'content' => (string)$response->getBody(),
            ]
        ];
    }
}
