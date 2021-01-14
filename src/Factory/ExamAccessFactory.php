<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\ExamAccess;

class ExamAccessFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): ExamAccess
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    public static function fromArray(array $data): ExamAccess
    {
        $entity = (new ExamAccess())
            ->setUuid($data['uuid'])
            ->setCertificationType($data['certificationType'])
            ->setCertificationVersion($data['certificationVersion'])
            ->setStatus($data['status'])
            ->setVoucher($data['voucher'] ?? null)
            ->setHistory($data['history'] ?? null);

        if ($data['certification'] ?? false) {
            $entity->setCertification(CertificationFactory::fromArray($data['certification']));
        }

        return $entity;
    }
}
