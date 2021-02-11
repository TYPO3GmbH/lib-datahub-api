<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Dto\Admin\CreateCompanyDto;
use T3G\DatahubApiLibrary\Dto\Admin\UpdateCompanyDto;
use T3G\DatahubApiLibrary\Entity\Company;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\CompanyFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class AdminCompanyApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function createCompany(CreateCompanyDto $company): Company
    {
        return CompanyFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/admin/companies'),
                json_encode($company, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function updateCompany(string $uuid, UpdateCompanyDto $company): Company
    {
        $this->isValidUuidOrThrow($uuid);

        return CompanyFactory::fromResponse(
            $this->client->request(
                'PUT',
                self::uri('/admin/companies/' . $uuid),
                json_encode($company, JSON_THROW_ON_ERROR)
            )
        );
    }
}
