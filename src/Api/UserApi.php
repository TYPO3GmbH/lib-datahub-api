<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\Certification;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\CertificationFactory;
use T3G\DatahubApiLibrary\Factory\CertificationListFactory;
use T3G\DatahubApiLibrary\Factory\EmployeeFactory;
use T3G\DatahubApiLibrary\Factory\UserFactory;
use T3G\DatahubApiLibrary\Factory\UserListFactory;

class UserApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @return array<int, mixed>
     */
    public function search(string $search): array
    {
        return UserListFactory::fromResponse(
            $this->client->request(
                'POST',
                '/users/search',
                json_encode(['term' => $search], JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @param string $username
     * @param bool $withOrders
     * @param bool $withSubscriptions
     * @return User
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getUser(string $username, bool $withOrders = false, bool $withSubscriptions = false): User
    {
        $queryParams = [];
        if ($withOrders) {
            $queryParams['withOrders'] = '1';
        }

        if ($withSubscriptions) {
            $queryParams['withSubscriptions'] = '1';
        }

        $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
        $url = sprintf('/users/%s%s', rawurlencode(mb_strtolower($username)), $queryString);

        return UserFactory::fromResponse(
            $this->client->request(
                'GET',
                $url,
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getProfile(string $username): User
    {
        return UserFactory::fromResponse(
            $this->client->request(
                'GET',
                sprintf('/users/%s/profile', rawurlencode(mb_strtolower($username))),
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function updateUser(string $username, User $user): User
    {
        return UserFactory::fromResponse(
            $this->client->request(
                'PUT',
                sprintf('/users/%s', rawurlencode(mb_strtolower($username))),
                json_encode($user, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCompanyHistory(string $username): array
    {
        $data = $this->client->request(
            'GET',
            sprintf('/users/%s/companies?history=1', rawurlencode(mb_strtolower($username))),
        );
        $data = json_decode($data->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        $history = [];
        foreach ($data as $employee) {
            $history[] = EmployeeFactory::fromArray($employee);
        }

        return $history;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCompanies(string $username): array
    {
        $data = $this->client->request(
            'GET',
            sprintf('/users/%s/companies', rawurlencode(mb_strtolower($username))),
        );
        $data = json_decode($data->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        $history = [];
        foreach ($data as $employee) {
            $history[] = EmployeeFactory::fromArray($employee);
        }

        return $history;
    }

    public function createCertification(string $username, Certification $certification): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'POST',
                sprintf('/users/%s/certifications', rawurlencode(mb_strtolower($username))),
                json_encode($certification, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function updateCertification(string $username, string $uuid, Certification $certification): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'PUT',
                sprintf('/users/%s/certifications/%s', rawurlencode(mb_strtolower($username)), urlencode($uuid)),
                json_encode($certification, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function getCertificationList(string $username, array $status = []): array
    {
        return CertificationListFactory::fromResponse(
            $this->client->request(
                'GET',
                sprintf('/users/%s/certifications?%s', rawurlencode(mb_strtolower($username)), ([] !== $status ? http_build_query(['status' => implode(',', $status)]) : '')),
            )
        );
    }
}
