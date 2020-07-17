<?php declare(strict_types = 1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Client\DataHubClient;
use T3G\DatahubApiLibrary\Entity\ExamAccess;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\ExamAccessFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class ExamAccessApi
{
    use HandlesUuids;

    private DataHubClient $client;

    public function __construct(DataHubClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getExamAccess(string $uuid): ExamAccess
    {
        $this->isValidUuidOrThrow($uuid);
        return ExamAccessFactory::fromResponse(
            $this->client->request(
                'GET',
                '/exam-access/' . $uuid,
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createExamAccess(string $username, ExamAccess $examAccess): ExamAccess
    {
        return ExamAccessFactory::fromResponse(
            $this->client->request(
                'POST',
                '/users/' . urlencode($username) . '/exam-access',
                json_encode($examAccess, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateExamAccess(string $uuid, ExamAccess $examAccess): ExamAccess
    {
        $this->isValidUuidOrThrow($uuid);

        return ExamAccessFactory::fromResponse(
            $this->client->request(
                'PUT',
                '/exam-access/' . $uuid,
                json_encode($examAccess, JSON_THROW_ON_ERROR, 512)
            )
        );
    }
}
