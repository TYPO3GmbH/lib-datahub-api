<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Api;

use Psr\Http\Client\ClientExceptionInterface;
use T3G\DatahubApiLibrary\Entity\Registration;
use T3G\DatahubApiLibrary\Entity\User;
use T3G\DatahubApiLibrary\Exception\DatahubResponseException;
use T3G\DatahubApiLibrary\Factory\RegistrationFactory;
use T3G\DatahubApiLibrary\Factory\UserFactory;

class RegistrationApi extends AbstractApi
{
    /**
     * @param Registration $registration
     *
     * @return Registration
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function register(Registration $registration): Registration
    {
        return RegistrationFactory::fromResponse(
            $this->client->request(
                'POST',
                self::uri('/registration/register'),
                json_encode($registration, JSON_THROW_ON_ERROR, 512)
            )
        );
    }

    /**
     * @param string $registrationToken
     *
     * @return User|Registration
     *
     * @throws ClientExceptionInterface
     * @throws DatahubResponseException
     */
    public function confirmRegistration(string $registrationToken)
    {
        $response = $this->client->request(
            'GET',
            self::uri('/registration/confirm/' . $registrationToken)
        );

        if (200 === $response->getStatusCode()) {
            return UserFactory::fromResponse($response);
        }

        return RegistrationFactory::fromResponse($response);
    }
}
