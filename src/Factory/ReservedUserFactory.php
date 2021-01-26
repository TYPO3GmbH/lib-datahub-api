<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\ReservedUser;

class ReservedUserFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): ReservedUser
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    /**
     * @param  array<string, mixed> $data
     *
     * @return ReservedUser
     */
    public static function fromArray(array $data): ReservedUser
    {
        return (new ReservedUser())
            ->setUuid($data['uuid'])
            ->setUsername($data['username'])
            ->setEmail($data['email'])
            ->setDeleteDate(new \DateTimeImmutable($data['deleteDate']))
            ->setOtrsIssue($data['otrsIssue'])
            ->setComment($data['comment'])
            ->setStatus($data['status']);
    }
}
