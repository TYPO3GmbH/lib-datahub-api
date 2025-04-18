<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Client;

use GuzzleHttp\Psr7\Utils;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerInterface;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Service\SecurityService;
use T3G\DatahubApiLibrary\Service\TokenServiceInterface;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class DataHubClient
{
    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;

    /**
     * @var TokenServiceInterface|string|null
     */
    private $token;
    private string $baseUri;
    private ?LoggerInterface $logger;

    /**
     * @param TokenServiceInterface|string $token
     */
    public function __construct(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        $token = null,
        string $baseUri = 'https://datahub.typo3.com/api',
        ?LoggerInterface $logger = null
    ) {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->token = $token;
        $this->baseUri = $baseUri;
        $this->logger = $logger;
    }

    /**
     * @return $this
     */
    public function setHttpClient(ClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function request(string $method, UriInterface $endpoint, ?string $body = null): ResponseInterface
    {
        $request = $this->requestFactory->createRequest($method, rtrim($this->baseUri, '/') . '/' . ltrim($endpoint->__toString(), '/'));
        if ($this->token instanceof TokenServiceInterface) {
            $token = $this->token->getToken();
        } else {
            $token = $this->token;
            if ($this->logger && null !== $token) {
                $this->logger->debug('[Datahub API Client] Request token provided was passed as string, which is deprecated. Please, either upgrade your implementation to consume an instance of {interface} or update t3g/symfony-datahub-bundle.', [
                    'interface' => TokenServiceInterface::class,
                ]);
            }
        }

        if (null !== $token && !$request->hasHeader('Authorization')) {
            $request = $request->withAddedHeader('Authorization', 'Bearer ' . $token);
        }
        if (!$request->hasHeader('Content-Type')) {
            $request = $request->withAddedHeader('Content-Type', 'application/json');
        }
        if (null !== $body) {
            $stream = Utils::streamFor($body);
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

    /**
     * @param string   $needle
     * @param string[] $haystack
     * @param bool     $caseInsensitive
     *
     * @return string[]
     */
    private function substrArray(string $needle, array $haystack, bool $caseInsensitive = false): array
    {
        return array_filter($haystack, static function ($item) use ($needle, $caseInsensitive) {
            return false !== ($caseInsensitive ? stripos($item, $needle) : strpos($item, $needle));
        });
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @return array<string, array<string, array<array<string>>|int|UriInterface|string>>
     *
     * @throws \JsonException
     */
    private function getLogContext(RequestInterface $request, ResponseInterface $response): array
    {
        $body = (string) $request->getBody();
        $bodyAsArray = [];
        if (!empty($body)) {
            $bodyAsArray = JsonUtility::decode($body);
        }

        return [
            'request' => [
                'method' => $request->getMethod(),
                'endpoint' => $request->getUri(),
                'body' => json_encode(SecurityService::anonymizeSensitiveData($bodyAsArray), JSON_THROW_ON_ERROR),
                'base_uri' => $this->baseUri,
                'headers' => $request->getHeaders(),
            ],
            'response' => [
                'status_code' => $response->getStatusCode(),
                'headers' => $response->getHeaders(),
                'content' => (string) $response->getBody(),
            ],
        ];
    }
}
