<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\ApprovedDocument;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\ApprovedDocumentFactory;

class ApprovedDocumentApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function approveDocument(string $username, ApprovedDocument $approvedDocument): ApprovedDocument
    {
        return ApprovedDocumentFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/approve-document'),
                json_encode($approvedDocument, JSON_THROW_ON_ERROR, 512)
            )
        );
    }
}
