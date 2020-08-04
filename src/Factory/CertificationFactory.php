<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use Psr\Http\Message\ResponseInterface;
use T3G\DatahubApiLibrary\Entity\Certification;

class CertificationFactory extends AbstractFactory
{
    public static function fromResponse(ResponseInterface $response): Certification
    {
        $data = self::responseToArray($response);

        return self::fromArray($data);
    }

    public static function fromArray(array $data): Certification
    {
        $certification = (new Certification())
            ->setUuid($data['uuid'])
            ->setType($data['type'])
            ->setVersion($data['version'])
            ->setStatus($data['status'])
            ->setExamLocation($data['examLocation'])
            ->setHistory($data['history'] ?? null)
            ->setHubspotDealId($data['hubspotDealId'] ?? null);

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
            $certification->setExamDate(new \DateTimeImmutable($data['validUntil']));
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
        return $certification;
    }
}
