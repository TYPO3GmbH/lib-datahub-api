<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Demand\OrganizationSearchDemand;
use T3G\DatahubApiLibrary\Dto\Admin\MergeCompanyDto;
use T3G\DatahubApiLibrary\Entity\Company;
use T3G\DatahubApiLibrary\Entity\CompanyInvitation;
use T3G\DatahubApiLibrary\Entity\EmailAddress;
use T3G\DatahubApiLibrary\Entity\Employee;
use T3G\DatahubApiLibrary\Entity\PreCheckResult;
use T3G\DatahubApiLibrary\Entity\VoucherCode;
use T3G\DatahubApiLibrary\Enum\MembershipType;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\CompanyFactory;
use T3G\DatahubApiLibrary\Factory\CompanyInvitationFactory;
use T3G\DatahubApiLibrary\Factory\CompanyInvitationListFactory;
use T3G\DatahubApiLibrary\Factory\CompanyListFactory;
use T3G\DatahubApiLibrary\Factory\EmailAddressFactory;
use T3G\DatahubApiLibrary\Factory\EmployeeFactory;
use T3G\DatahubApiLibrary\Factory\PreCheckResultListFactory;
use T3G\DatahubApiLibrary\Factory\VoucherCodeFactory;
use T3G\DatahubApiLibrary\Utility\JsonUtility;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class CompanyApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @return Company[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function search(OrganizationSearchDemand $search): array
    {
        return CompanyListFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/companies/search'),
                json_encode($search, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @param string          $sourceCompany
     * @param string          $targetCompany
     * @param MergeCompanyDto $mergeCompanyDto
     *
     * @return array<string, string>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function merge(string $sourceCompany, string $targetCompany, MergeCompanyDto $mergeCompanyDto): array
    {
        $response = $this->client->request(
            'POST',
            self::uri(sprintf('/companies/merge/%s/%s', $sourceCompany, $targetCompany)),
            json_encode($mergeCompanyDto, JSON_THROW_ON_ERROR)
        );

        return JsonUtility::decode((string) $response->getBody());
    }

    /**
     * @return Company[]
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function listCompanies(bool $withOrders = false, bool $withSubscriptions = false, bool $withVoucherCodes = false, bool $withEltsPlans = false): array
    {
        $response = $this->client->request(
            'GET',
            self::uri('/companies/list')->withQuery(http_build_query([
                'withOrders' => (int) $withOrders,
                'withSubscriptions' => (int) $withSubscriptions,
                'withVoucherCodes' => (int) $withVoucherCodes,
                'withEltsPlans' => (int) $withEltsPlans,
            ]))
        );
        $data = JsonUtility::decode((string) $response->getBody());

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
    public function getCompany(string $uuid, bool $withOrders = false, bool $withSubscriptions = false, bool $withVoucherCodes = false, bool $withEltsPlans = false): Company
    {
        $this->isValidUuidOrThrow($uuid);

        return CompanyFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/companies/' . $uuid)->withQuery(http_build_query([
                    'withOrders' => (int) $withOrders,
                    'withSubscriptions' => (int) $withSubscriptions,
                    'withVoucherCodes' => (int) $withVoucherCodes,
                    'withEltsPlans' => (int) $withEltsPlans,
                ]))
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
                self::uri('/companies'),
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
                self::uri('/companies/' . $uuid),
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
            self::uri('/companies/' . $uuid),
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
                self::uri('/companies/' . $uuid . '/invite/' . mb_strtolower($username) . '/' . $role),
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
                self::uri('/companies/confirm/' . $invitationCode),
            )
        );
    }

    public function revokeEmployeeInvitation(string $uuid, string $invitationCode): void
    {
        $this->isValidUuidOrThrow($uuid);
        $this->isValidUuidOrThrow($invitationCode);

        $this->client->request(
            'DELETE',
            self::uri('/companies/' . $uuid . '/invitations/' . $invitationCode)
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
                self::uri('/companies/' . $uuid . '/invitations')
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
                self::uri('/employees/' . $employeeUuid . '/roles'),
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
            self::uri('/employees/dismiss/' . $employeeUuid),
        );
    }

    /**
     * @param string $companyUuid
     *
     * @return PreCheckResult[]
     *
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
                self::uri('/companies/' . $companyUuid . '/pre-deletion-check')
            )
        );
    }

    public function createEmail(string $uuid, EmailAddress $emailAddress): EmailAddress
    {
        $this->isValidUuidOrThrow($uuid);

        return EmailAddressFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/companies/' . $uuid . '/emails'),
                json_encode($emailAddress, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    public function createVoucherCode(string $uuid, VoucherCode $voucherCode): VoucherCode
    {
        $this->isValidUuidOrThrow($uuid);

        return VoucherCodeFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/companies/' . $uuid . '/voucher-codes'),
                json_encode($voucherCode, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @param string $uuid
     *
     * @return array<int, MembershipType::*>
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws \JsonException
     */
    public function getAllowedMemberships(string $uuid): array
    {
        $this->isValidUuidOrThrow($uuid);

        $response = $this->client->request(
            'GET',
            self::uri('/companies/' . $uuid . '/allowed-memberships'),
        );

        return JsonUtility::decode((string) $response->getBody());
    }
}
