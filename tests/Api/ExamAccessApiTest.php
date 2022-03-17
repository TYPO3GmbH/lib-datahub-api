<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\ExamAccessApi;
use T3G\DatahubApiLibrary\Entity\ExamAccess;
use T3G\DatahubApiLibrary\Enum\CertificationType;
use T3G\DatahubApiLibrary\Enum\CertificationVersion;
use T3G\DatahubApiLibrary\Enum\ExamAccessStatus;

class ExamAccessApiTest extends AbstractApiTest
{
    public function testGetExamAccess(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ExamAccessApi/GetExamAccessResponse.php'
        ]);
        $api = new ExamAccessApi($this->getClient($handler));
        $entity = $api->getExamAccess('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $entity->getUuid());
        $this->assertEquals(CertificationVersion::SEVEN, $entity->getCertificationVersion());
        $this->assertEquals(CertificationType::TCCI, $entity->getCertificationType());
        $this->assertEquals(ExamAccessStatus::NEW, $entity->getStatus());
    }

    public function testCreateExamAccessForUser(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ExamAccessApi/CreateExamAccessForUserResponse.php'
        ]);
        $api = new ExamAccessApi($this->getClient($handler));
        $entity = $api->createExamAccessForUser('oelie-boelie', $this->getTestExamAccess());
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $entity->getUuid());
        $this->assertEquals(CertificationVersion::SEVEN, $entity->getCertificationVersion());
        $this->assertEquals(CertificationType::TCCD, $entity->getCertificationType());
        $this->assertEquals(ExamAccessStatus::NEW, $entity->getStatus());
    }

    public function testCreateExamAccessForCompany(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ExamAccessApi/CreateExamAccessForCompanyResponse.php'
        ]);
        $api = new ExamAccessApi($this->getClient($handler));
        $entity = $api->createExamAccessForCompany('00000000-0000-0000-0000-000000000000', $this->getTestExamAccess());
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $entity->getUuid());
        $this->assertEquals(CertificationVersion::TEN, $entity->getCertificationVersion());
        $this->assertEquals(CertificationType::TCCC, $entity->getCertificationType());
        $this->assertEquals(ExamAccessStatus::NEW, $entity->getStatus());
    }

    public function testUpdateExamAccess(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ExamAccessApi/UpdateExamAccessResponse.php'
        ]);
        $api = new ExamAccessApi($this->getClient($handler));
        $entity = $api->updateExamAccess('00000000-0000-0000-0000-000000000000', $this->getTestExamAccess());
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $entity->getUuid());
        $this->assertEquals(CertificationVersion::SEVEN, $entity->getCertificationVersion());
        $this->assertEquals(CertificationType::TCCD, $entity->getCertificationType());
        $this->assertEquals(ExamAccessStatus::NEW, $entity->getStatus());
    }

    public function testTransferExamAccess(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ExamAccessApi/TransferExamAccessResponse.php'
        ]);
        $api = new ExamAccessApi($this->getClient($handler));
        $entity = $api->transferExamAccess('00000000-0000-0000-0000-000000000000', 'boelie-oelie');
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $entity->getUuid());
        $this->assertEquals(CertificationVersion::SEVEN, $entity->getCertificationVersion());
        $this->assertEquals(CertificationType::TCCD, $entity->getCertificationType());
        $this->assertEquals(ExamAccessStatus::NEW, $entity->getStatus());
        $this->assertEquals('Exam access transferred from oelie.boelie to boelie.oelie (by oelie.boelie)', $entity->getHistory());
    }

    public function testDeleteExamAccess(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ExamAccessApi/DeleteExamAccessResponse.php'
        ]);
        $api = new ExamAccessApi($this->getClient($handler));
        try {
            $api->deleteExamAccess('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        $this->assertFalse($anExceptionWasThrown);
    }

    public function getTestExamAccess(): ExamAccess
    {
        return (new ExamAccess())
            ->setStatus(ExamAccessStatus::NEW)
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setCertificationType(CertificationType::TCCD)
            ->setCertificationVersion(CertificationVersion::SEVEN)
            ->setVoucher('00000000-0000-0000-0000-000000000000');
    }
}
