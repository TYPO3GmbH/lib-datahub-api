<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\Certification;

/**
 * @extends AbstractFactory<Certification>
 */
class CertificationFactory extends AbstractFactory
{
    public static function fromArray(array $data): Certification
    {
        $certification = (new Certification())
            ->setUuid($data['uuid'])
            ->setType($data['type'])
            ->setVersion($data['version'])
            ->setAuditType($data['auditType'])
            ->setStatus($data['status'])
            ->setExamLocation($data['examLocation'])
            ->setHistory($data['history'] ?? null)
            ->setPostFormattedAddress($data['postFormattedAddress'] ?? []);

        if (isset($data['user'])) {
            $certification->setUser($data['user']);
        }
        if (isset($data['address'])) {
            $certification->setAddress($data['address']);
        }
        if (isset($data['examDate'])) {
            $certification->setExamDate(new \DateTimeImmutable($data['examDate']));
        }
        if (isset($data['validUntil'])) {
            $certification->setValidUntil(new \DateTimeImmutable($data['validUntil']));
        }
        if (isset($data['proctoringLink'])) {
            $certification->setProctoringLink($data['proctoringLink']);
        }
        if (isset($data['examUrl'])) {
            $certification->setExamUrl($data['examUrl']);
        }
        if (isset($data['proctoringStatus'])) {
            $certification->setProctoringStatus($data['proctoringStatus']);
        }
        if (isset($data['examTestResult'])) {
            $certification->setExamTestResult($data['examTestResult']);
        }
        if (isset($data['certificatePrintDate'])) {
            $certification->setCertificatePrintDate(new \DateTimeImmutable($data['certificatePrintDate']));
        }
        if (isset($data['incidents'])) {
            $certification->setIncidents($data['incidents']);
        }
        if (isset($data['proctoringApproval'])) {
            $certification->setProctoringApproval($data['proctoringApproval']);
        }
        if (isset($data['ndaSigned'])) {
            $certification->setNdaSigned($data['ndaSigned']);
        }
        if (isset($data['rulesAccepted'])) {
            $certification->setRulesAccepted($data['rulesAccepted']);
        }
        if (isset($data['userExamUuid'])) {
            $certification->setUserExamUuid($data['userExamUuid']);
        }
        if (isset($data['eventUuid'])) {
            $certification->setEventUuid($data['eventUuid']);
        }
        if (isset($data['finished'])) {
            $certification->setFinished($data['finished']);
        }

        return $certification;
    }
}
