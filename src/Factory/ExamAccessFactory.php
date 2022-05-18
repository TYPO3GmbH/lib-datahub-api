<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\ExamAccess;

/**
 * @extends AbstractFactory<ExamAccess>
 */
class ExamAccessFactory extends AbstractFactory
{
    public static function fromArray(array $data): ExamAccess
    {
        $examAccess = (new ExamAccess())
            ->setUuid($data['uuid'])
            ->setCertificationType($data['certificationType'])
            ->setCertificationVersion($data['certificationVersion'])
            ->setStatus($data['status'])
            ->setVoucher($data['voucher'] ?? null)
            ->setHistory($data['history'] ?? null)
            ->setUsed($data['used'] ?? false)
        ;

        if (isset($data['createdAt'])) {
            $examAccess->setCreatedAt($data['createdAt'] ? new \DateTime($data['createdAt']) : null);
        }
        if (isset($data['validUntil'])) {
            $examAccess->setValidUntil($data['validUntil'] ? new \DateTime($data['validUntil']) : null);
        }
        if (isset($data['user'])) {
            $examAccess->setUser(UserFactory::fromArray($data['user']));
        }
        if (isset($data['company'])) {
            $examAccess->setCompany(CompanyFactory::fromArray($data['company']));
        }

        return $examAccess;
    }
}
