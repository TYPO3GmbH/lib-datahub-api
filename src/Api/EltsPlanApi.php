<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Dto\CreateEltsPlanDto;
use T3G\DatahubApiLibrary\Entity\EltsPlan;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Exception\InvalidUuidException;
use T3G\DatahubApiLibrary\Factory\EltsPlanFactory;
use T3G\DatahubApiLibrary\Validation\HandlesUuids;

class EltsPlanApi extends AbstractApi
{
    use HandlesUuids;

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function createEltsPlanForUser(string $username, CreateEltsPlanDto $eltsPlan): EltsPlan
    {
        return EltsPlanFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/users/' . mb_strtolower($username) . '/elts-plan'),
                json_encode($eltsPlan, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function createEltsPlanForCompany(string $uuid, CreateEltsPlanDto $eltsPlan): EltsPlan
    {
        $this->isValidUuidOrThrow($uuid);

        return EltsPlanFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/companies/' . $uuid . '/elts-plan'),
                json_encode($eltsPlan, JSON_THROW_ON_ERROR)
            )
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     * @throws InvalidUuidException
     */
    public function getPlan(string $uuid): EltsPlan
    {
        $this->isValidUuidOrThrow($uuid);

        return EltsPlanFactory::fromResponse(
            $this->client->request(
                'GET',
                self::uri('/elts/plan/' . $uuid)
            )
        );
    }
}
