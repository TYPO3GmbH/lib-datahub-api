<?php declare(strict_types=1);

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
                '/content/' . $identifier . '/' . $version . '/' . $format
            )
        );
    }
}
