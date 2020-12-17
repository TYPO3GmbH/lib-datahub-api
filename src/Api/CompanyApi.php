<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\Company;
use T3G\DatahubApiLibrary\Entity\CompanyInvitation;
use T3G\DatahubApiLibrary\Entity\EmailAddress;
use T3G\DatahubApiLibrary\Entity\Employee;
use T3G\DatahubApiLibrary\Entity\PreCheckResult;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\CompanyFactory;
use T3G\DatahubApiLibrary\Factory\CompanyInvitationFactory;
use T3G\DatahubApiLibrary\Factory\CompanyInvitationListFactory;
use T3G\DatahubApiLibrary\Factory\CompanyListFactory;
use T3G\DatahubApiLibrary\Factory\EmailAddressFactory;
use T3G\DatahubApiLibrary\Factory\EmployeeFactory;
use T3G\DatahubApiLibrary\Factory\PreCheckResultListFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class CompanyApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @return array<int, mixed>
     */
    public function search(string $search): array
    {
        return CompanyListFactory::fromResponse(
            $this->client->request(
                'POST',
                '/companies/search',
                json_encode(['term' => $search], JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @return Company[]
     */
    public function listCompanies(bool $withOrders = false, bool $withSubscriptions = false): array
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

        $data = $this->client->request('GET', $url);
        $data = json_decode((string)$data->getBody(), true, 512, JSON_THROW_ON_ERROR);

        $companies = [];
        foreach ($data as $datum) {
            $companies[] = CompanyFactory::fromArray($datum);
        }
        return $companies;
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
                '/companies/' . $uuid . '/invite/' . rawurlencode(mb_strtolower($username)) . '/' . urlencode($role),
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

    /**
     * @param string $companyUuid
     * @return PreCheckResult[]
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function deletionPreCheck(string $companyUuid): array
    {
        $this->isValidUuidOrThrow($companyUuid);

        return PreCheckResultListFactory::fromResponse(
            $this->client->request(
                'GET',
                sprintf('/companies/%s/pre-deletion-check', $companyUuid)
            )
        );
    }

    public function createEmail(string $uuid, EmailAddress $emailAddress): EmailAddress
    {
        return EmailAddressFactory::fromResponse(
            $this->client->request(
                'POST',
                sprintf('/companies/%s/emails', $uuid),
                json_encode($emailAddress, JSON_THROW_ON_ERROR, 512)
            )
        );
    }
}
