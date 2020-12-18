<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\UserEmail;

class UserEmailFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): UserEmail
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    /**
     * @param array<string, string> $data
     * @return UserEmail
     */
    public static function fromArray(array $data): UserEmail
    {
        return (new UserEmail())
            ->setUserName($data['username'])
            ->setEmail($data['email']);
    }
}
