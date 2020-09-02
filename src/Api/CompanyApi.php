<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Client\DataHubClient;
use T3G\DatahubApiLibrary\Entity\Company;
use T3G\DatahubApiLibrary\Entity\CompanyInvitation;
use T3G\DatahubApiLibrary\Entity\Employee;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\CompanyFactory;
use T3G\DatahubApiLibrary\Factory\CompanyInvitationFactory;
use T3G\DatahubApiLibrary\Factory\CompanyInvitationListFactory;
use T3G\DatahubApiLibrary\Factory\EmployeeFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class CompanyApi
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
     */
    public function listCompanies(bool $withOrders = false, bool $withSubscriptions = false): Company
    {
        $queryParams = [];
        if ($withOrders) {
            $queryParams['withOrders'] = '1';
        }

        if ($withSubscriptions) {
            $queryParams['withSubscriptions'] = '1';
        }

        $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
        $url = sprintf('/companies/list%s', $queryString);

        return CompanyFactory::fromResponse(
            $this->client->request(
                'GET',
                $url,
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getCompany(string $uuid, bool $withOrders = false, bool $withSubscriptions = false): Company
    {
        $this->isValidUuidOrThrow($uuid);

        $queryParams = [];
        if ($withOrders) {
            $queryParams['withOrders'] = '1';
        }

        if ($withSubscriptions) {
            $queryParams['withSubscriptions'] = '1';
        }

        $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
        $url = sprintf('/companies/%s%s', $uuid, $queryString);

        return CompanyFactory::fromResponse(
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
    public function createCompany(Company $company): Company
    {
        return CompanyFactory::fromResponse(
            $this->client->request(
                'POST',
                '/companies',
                json_encode($company, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateCompany(string $uuid, Company $company): Company
    {
        $this->isValidUuidOrThrow($uuid);

        return CompanyFactory::fromResponse(
            $this->client->request(
                'PUT',
                '/companies/' . $uuid,
                json_encode($company, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteCompany(string $uuid): void
    {
        $this->isValidUuidOrThrow($uuid);

        $this->client->request(
            'DELETE',
            '/companies/' . $uuid,
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function inviteEmployee(string $uuid, string $username, string $role): CompanyInvitation
    {
        $this->isValidUuidOrThrow($uuid);

        return CompanyInvitationFactory::fromResponse(
            $this->client->request(
                'GET',
                '/companies/' . $uuid . '/invite/' . urlencode(mb_strtolower($username)) . '/' . urlencode($role),
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function confirmEmployeeInvitation(string $invitationCode): Employee
    {
        $this->isValidUuidOrThrow($invitationCode);

        return EmployeeFactory::fromResponse(
            $this->client->request(
                'GET',
                '/companies/confirm/' . urlencode($invitationCode),
            )
        );
    }

    public function revokeEmployeeInvitation(string $uuid, string $invitationCode): void
    {
        $this->isValidUuidOrThrow($uuid);
        $this->isValidUuidOrThrow($invitationCode);

        $this->client->request(
            'DELETE',
            '/companies/' . $uuid . '/invitations/' . $invitationCode
        );
    }

    /**
     * @return CompanyInvitation[]
     */
    public function getOpenInvitations(string $uuid): array
    {
        $this->isValidUuidOrThrow($uuid);

        return CompanyInvitationListFactory::fromResponse(
            $this->client->request(
                'GET',
                '/companies/' . $uuid . '/invitations'
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateEmployee(string $employeeUuid, string $role): Employee
    {
        $this->isValidUuidOrThrow($employeeUuid);

        return EmployeeFactory::fromResponse(
            $this->client->request(
                'PUT',
                '/employees/' . $employeeUuid . '/roles',
                json_encode(['role' => $role], JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deleteEmployee(string $employeeUuid): void
    {
        $this->isValidUuidOrThrow($employeeUuid);

        $this->client->request(
            'PUT',
            '/employees/dismiss/' . $employeeUuid,
        );
    }
}
