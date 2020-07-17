<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use DateTime;
use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\Membership;

class MembershipFactory extends AbstractFactory
{
    /**
     * @param ResponseInterface $response
     * @return Membership
     * @codeCoverageIgnore This never happens, is always a sub-object
     */
    public static function fromResponse(ResponseInterface $response): Membership
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    public static function fromArray(array $data): Membership
    {
        return (new Membership())
            ->setType($data['type'])
            ->setValidUntil(new DateTime($data['validUntil']));
    }
}
