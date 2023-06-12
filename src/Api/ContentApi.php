<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\Content;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\ContentFactory;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class ContentApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getDocument(string $identifier, string $version = 'latest', string $format = 'html'): Content
    {
        return ContentFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/content'),
                json_encode([
                    'identifier' => $identifier,
                    'version' => $version,
                    'format' => $format,
                ], JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getFAQ(string $identifier = '_all'): Content
    {
        return ContentFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri(sprintf('/content/faq/%s', $identifier))
            )
        );
    }

    /**
     * @return array<int, array{type: string, name: string}>
     */
    public function getDirectory(string $directory, string $ref = 'master'): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/content/directory')->withQuery(http_build_query([
                'd' => $directory,
                'ref' => $ref,
            ]))
        );

        return JsonUtility::decode((string) $response->getBody());
    }
}
