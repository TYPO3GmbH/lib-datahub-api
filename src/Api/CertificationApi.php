<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use T3G\DatahubApiLibrary\Client\DataHubClient;
use T3G\DatahubApiLibrary\Entity\Certification;
use T3G\DatahubApiLibrary\Factory\CertificationFactory;
use T3G\DatahubApiLibrary\Factory\CertificationListFactory;

class CertificationApi
{
    private DataHubClient $client;

    public function __construct(DataHubClient $client)
    {
        $this->client = $client;
    }

    public function importCertification(string $username, Certification $certification): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'POST',
                sprintf('/certifications/import/%s', urlencode(mb_strtolower($username))),
                json_encode($certification, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @param array $filterAttributes
     * @return Certification[]
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \T3G\DatahubApiLibrary\Exception\DatahubResponseException
     */
    public function getCertifications(array $filterAttributes = []): array
    {
        $url = '/certifications/';
        if ([] !== $filterAttributes) {
            $url .= '?' . http_build_query($filterAttributes);
        }
        return CertificationListFactory::fromResponse(
            $this->client->request(
                'GET',
                $url
            )
        );
    }

    public function getCertification(string $uuid, bool $withHistory = false): Certification
    {
        $url = '/certifications/' . urlencode($uuid);
        if ($withHistory) {
            $url .= '?withHistory=1';
        }
        return CertificationFactory::fromResponse(
            $this->client->request(
                'GET',
                $url
            )
        );
    }

    public function setResult(string $uuid, string $result): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'PUT',
                '/certifications/' . urlencode($uuid) . '/test-result',
                json_encode([
                    'examTestResult' => $result,
                ], JSON_THROW_ON_ERROR)
            )
        );
    }

    public function startCertification(string $uuid): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'PUT',
                '/certifications/' . urlencode($uuid) . '/start',
                json_encode([
                    'examDate' => (new \DateTimeImmutable())->format(\DateTimeInterface::ATOM)
                ], JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @return Certification[]
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \T3G\DatahubApiLibrary\Exception\DatahubResponseException
     */
    public function getCertificationsForPrint(): array
    {
        return CertificationListFactory::fromResponse(
            $this->client->request(
                'GET',
                '/certifications/get-for-print',
            )
        );
    }

    public function setCertificationsPrintDate(array $uuids): void
    {
        $this->client->request(
            'PUT',
            '/certifications/send-to-print',
            json_encode([
                'certifications' => $uuids
            ], JSON_THROW_ON_ERROR)
        );
    }

    public function deleteCertification(string $uuid): void
    {
        $this->client->request('DELETE', '/certifications/' . $uuid . '/delete');
    }
}
