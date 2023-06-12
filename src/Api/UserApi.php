<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\Certification;
use T3G\DatahubApiLibrary\Entity\EmailAddress;
use T3G\DatahubApiLibrary\Entity\Employee;
use T3G\DatahubApiLibrary\Entity\PreCheckResult;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Entity\VoucherCode;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\CertificationFactory;
use T3G\DatahubApiLibrary\Factory\CertificationListFactory;
use T3G\DatahubApiLibrary\Factory\EmailAddressFactory;
use T3G\DatahubApiLibrary\Factory\EmployeeFactory;
use T3G\DatahubApiLibrary\Factory\PreCheckResultListFactory;
use T3G\DatahubApiLibrary\Factory\UserFactory;
use T3G\DatahubApiLibrary\Factory\UserListFactory;
use T3G\DatahubApiLibrary\Factory\VoucherCodeFactory;
use T3G\DatahubApiLibrary\Utility\JsonUtility;

class UserApi extends AbstractApi
{
    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createUser(User $user): User
    {
        return UserFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users'),
                json_encode([
                    'username' => $user->getUsername(),
                    'password' => $user->getPassword(),
                    'firstName' => $user->getFirstName(),
                    'lastName' => $user->getLastName(),
                    'email' => $user->getPrimaryEmail(false),
                ], JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @return array<int, User>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function search(string $search): array
    {
        return UserListFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/search'),
                json_encode(['term' => $search], JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @param string $username
     * @param bool   $withOrders
     * @param bool   $withSubscriptions
     * @param bool   $withVoucherCodes
     * @param bool   $withEltsPlans
     * @param bool   $withEltsAccessTokens
     * @param bool   $withEltsGitPublicTokens
     *
     * @return User
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getUser(string $username, bool $withOrders = false, bool $withSubscriptions = false, bool $withVoucherCodes = false, bool $withEltsPlans = false, bool $withEltsAccessTokens = false, bool $withEltsGitPublicTokens = false): User
    {
        return UserFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/users/' . mb_strtolower($username))->withQuery(http_build_query([
                    'withOrders' => (int) $withOrders,
                    'withSubscriptions' => (int) $withSubscriptions,
                    'withVoucherCodes' => (int) $withVoucherCodes,
                    'withEltsPlans' => (int) $withEltsPlans,
                    'withEltsAccessTokens' => (int) $withEltsAccessTokens,
                    'withEltsGitPublicTokens' => (int) $withEltsGitPublicTokens,
                ])),
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
                self::uri('/users/' . mb_strtolower($username) . '/profile')
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
                self::uri('/users/' . mb_strtolower($username)),
                json_encode($user, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @return Employee[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCompanyHistory(string $username): array
    {
        $data = $this->client->request(
            'GET',
            self::uri('/users/' . mb_strtolower($username) . '/companies')->withQuery(http_build_query(['history' => 1]))
        );
        $data = JsonUtility::decode((string) $data->getBody());

        $history = [];
        foreach ($data as $employee) {
            $history[] = EmployeeFactory::fromArray($employee);
        }

        return $history;
    }

    /**
     * @return Employee[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCompanies(string $username): array
    {
        $data = $this->client->request(
            'GET',
            self::uri('/users/' . mb_strtolower($username) . '/companies')
        );
        $data = JsonUtility::decode((string) $data->getBody());

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
                self::uri('/users/' . mb_strtolower($username) . '/certifications'),
                json_encode($certification, JSON_THROW_ON_ERROR)
            )
        );
    }

    public function updateCertification(string $username, string $uuid, Certification $certification): Certification
    {
        return CertificationFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/users/' . mb_strtolower($username) . '/certifications/' . $uuid),
                json_encode($certification, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @param string   $username
     * @param string[] $status
     *
     * @return Certification[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function getCertificationList(string $username, array $status = []): array
    {
        return CertificationListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/users/' . mb_strtolower($username) . '/certifications')->withQuery([] !== $status ? http_build_query(['status' => implode(',', $status)]) : '')
            )
        );
    }

    public function createEmail(string $username, EmailAddress $emailAddress): EmailAddress
    {
        return EmailAddressFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/emails'),
                json_encode($emailAddress, JSON_THROW_ON_ERROR)
            )
        );
    }

    public function createVoucherCode(string $username, VoucherCode $voucherCode): VoucherCode
    {
        return VoucherCodeFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/voucher-codes'),
                json_encode($voucherCode, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @param string $username
     *
     * @return array<int, MembershipType::*>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function getAllowedMemberships(string $username): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/users/' . mb_strtolower($username) . '/allowed-memberships'),
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    /**
     * @param string $username
     *
     * @return PreCheckResult[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function deletionPreCheck(string $username): array
    {
        return PreCheckResultListFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/users/' . mb_strtolower($username) . '/user-pre-deletion-check')
            )
        );
    }
}
