<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\ExamAccess;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\ExamAccessFactory;
use T3G\DatahubApiLibrary\Factory\ExamAccessListFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class ExamAccessApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @param array<string, string> $filterAttributes
     *
     * @return ExamAccess[]
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \T3G\DatahubApiLibrary\Exception\DatahubResponseException
     */
    public function getExamAccesses(array $filterAttributes = []): array
    {
        return ExamAccessListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/exam-access/')->withQuery(http_build_query($filterAttributes))
            )
        );
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
                self::uri('/exam-access/' . $uuid),
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getByVoucher(string $uuid): ExamAccess
    {
        $this->isValidUuidOrThrow($uuid);

        return ExamAccessFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/exam-access/voucher/' . $uuid),
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createExamAccessForUser(string $username, ExamAccess $examAccess): ExamAccess
    {
        return ExamAccessFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/exam-access'),
                json_encode($examAccess, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function createExamAccessForCompany(string $companyUuid, ExamAccess $examAccess): ExamAccess
    {
        $this->isValidUuidOrThrow($companyUuid);

        return ExamAccessFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/companies/' . $companyUuid . '/exam-access'),
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
                self::uri('/exam-access/' . $uuid),
                json_encode($examAccess, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function transferExamAccess(string $uuid, string $username): ExamAccess
    {
        $this->isValidUuidOrThrow($uuid);

        return ExamAccessFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/exam-access/' . $uuid . '/transfer'),
                json_encode(['user' => $username], JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteExamAccess(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            self::uri('/exam-access/' . $uuid),
        );
    }
}
