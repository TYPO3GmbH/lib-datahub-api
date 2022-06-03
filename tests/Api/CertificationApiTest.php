<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\CertificationApi;
use T3G\DatahubApiLibrary\Entity\Address;
use T3G\DatahubApiLibrary\Entity\Certification;

class CertificationApiTest extends AbstractApiTest
{
    public function testGetCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationResponse.php'
        ]);
        $certification = (new CertificationApi($this->getClient($handler)))->getCertification('00000000-0000-0000-0000-000000000000', true);
        $this->assertSame('00000000-0000-0000-0000-000000000000', $certification->getUuid());
        $this->assertSame('TCCE', $certification->getType());
        $this->assertSame('foo bar', $certification->getAddress());
        $this->assertSame('UNKNOWN', $certification->getStatus());
        $this->assertSame('online', $certification->getExamLocation());
        $this->assertSame('1234', $certification->getHubspotDealId());
        $this->assertSame('2020-06-02T00:00:00+00:00', $certification->getExamDate()->format(\DateTimeInterface::ATOM));
        $this->assertSame('https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000', $certification->getExamUrl());
        $this->assertSame('a5a90afd-9495-4ce1-aaef-3f5ccb0e7ec6', $certification->getUserExamUuid());
        $this->assertNull($certification->getCertificatePrintDate());
    }

    public function testGetCertifications(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationsResponse.php'
        ]);
        $certifications = (new CertificationApi($this->getClient($handler)))->getCertifications(['type' => 'TCCD']);
        $certification = $certifications[0];
        $this->assertSame('00000000-0000-0000-0000-000000000000', $certification->getUuid());
        $this->assertSame('TCCE', $certification->getType());
        $this->assertSame('foo bar', $certification->getAddress());
        $this->assertSame('UNKNOWN', $certification->getStatus());
        $this->assertSame('online', $certification->getExamLocation());
        $this->assertSame('1234', $certification->getHubspotDealId());
        $this->assertSame('2020-06-02T00:00:00+00:00', $certification->getExamDate()->format(\DateTimeInterface::ATOM));
        $this->assertSame('https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000', $certification->getExamUrl());
        $this->assertNull($certification->getCertificatePrintDate());
    }

    public function testGetCertificationsForListing(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationsForListingResponse.php'
        ]);
        $certifications = (new CertificationApi($this->getClient($handler)))->getCertificationsForListing();
        $certification = $certifications[0];
        $this->assertSame('00000000-0000-0000-0000-000000000000', $certification->getUuid());
        $this->assertSame('TCCE', $certification->getType());
        $this->assertSame('foo bar', $certification->getAddress());
        $this->assertSame('UNKNOWN', $certification->getStatus());
        $this->assertSame('online', $certification->getExamLocation());
        $this->assertSame('1234', $certification->getHubspotDealId());
        $this->assertSame('2020-06-02T00:00:00+00:00', $certification->getExamDate()->format(\DateTimeInterface::ATOM));
        $this->assertSame('https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000', $certification->getExamUrl());
        $this->assertNull($certification->getCertificatePrintDate());
    }

    public function testGetCertificationsForListingFilteredByType(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationsForListingResponseFilteredByType.php'
        ]);
        $certifications = (new CertificationApi($this->getClient($handler)))->getCertificationsForListing('TCEE');
        $certification = $certifications[0];
        $this->assertSame('00000000-0000-0000-0000-000000000000', $certification->getUuid());
        $this->assertSame('TCCE', $certification->getType());
        $this->assertSame('foo bar', $certification->getAddress());
        $this->assertSame('UNKNOWN', $certification->getStatus());
        $this->assertSame('online', $certification->getExamLocation());
        $this->assertSame('1234', $certification->getHubspotDealId());
        $this->assertSame('2020-06-02T00:00:00+00:00', $certification->getExamDate()->format(\DateTimeInterface::ATOM));
        $this->assertSame('https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000', $certification->getExamUrl());
        $this->assertNull($certification->getCertificatePrintDate());
    }

    public function testGetCertificationsForPrint(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationsResponse.php'
        ]);
        $certifications = (new CertificationApi($this->getClient($handler)))->getCertificationsForPrint();
        $certification = $certifications[0];
        $this->assertSame('00000000-0000-0000-0000-000000000000', $certification->getUuid());
        $this->assertSame('TCCE', $certification->getType());
        $this->assertSame('foo bar', $certification->getAddress());
        $this->assertSame('UNKNOWN', $certification->getStatus());
        $this->assertSame('online', $certification->getExamLocation());
        $this->assertSame('1234', $certification->getHubspotDealId());
        $this->assertSame('2020-06-02T00:00:00+00:00', $certification->getExamDate()->format(\DateTimeInterface::ATOM));
        $this->assertSame('https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000', $certification->getExamUrl());
        $this->assertNull($certification->getCertificatePrintDate());
    }

    public function testSetCertificationPrintDate(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        try {
            (new CertificationApi($this->getClient($handler)))->setCertificationsPrintDate(['00000000-0000-0000-0000-000000000000']);
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        $this->assertFalse($anExceptionWasThrown);
    }

    public function testSetResult(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationResponse.php'
        ]);
        $certification = (new CertificationApi($this->getClient($handler)))->setResult('00000000-0000-0000-0000-000000000000', 'PASSED');
        $this->assertSame('00000000-0000-0000-0000-000000000000', $certification->getUuid());
        $this->assertSame('TCCE', $certification->getType());
        $this->assertSame('foo bar', $certification->getAddress());
        $this->assertSame('UNKNOWN', $certification->getStatus());
        $this->assertSame('online', $certification->getExamLocation());
        $this->assertSame('2020-06-02T00:00:00+00:00', $certification->getExamDate()->format(\DateTimeInterface::ATOM));
        $this->assertSame('https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000', $certification->getExamUrl());
        $this->assertNull($certification->getCertificatePrintDate());
    }

    public function testImportCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationResponse.php'
        ]);
        $certification = (new CertificationApi($this->getClient($handler)))->importCertification('oelie-boelie', $this->getTestCertificate());
        $this->assertSame('00000000-0000-0000-0000-000000000000', $certification->getUuid());
        $this->assertSame('TCCE', $certification->getType());
        $this->assertSame('foo bar', $certification->getAddress());
        $this->assertSame('UNKNOWN', $certification->getStatus());
        $this->assertSame('online', $certification->getExamLocation());
        $this->assertSame('2020-06-02T00:00:00+00:00', $certification->getExamDate()->format(\DateTimeInterface::ATOM));
        $this->assertSame('https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000', $certification->getExamUrl());
        $this->assertNull($certification->getCertificatePrintDate());
    }

    public function testSetCertificationAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationSetAddressResponse.php'
        ]);
        $certification = (new CertificationApi($this->getClient($handler)))->setAddress(
            '00000000-0000-0000-0000-000000000000',
            $this->getTestCertificationAddress()->toDeutschePostArray(),
            ''
        );
        $this->assertSame('Max Mustermann', $certification->getPostFormattedAddress()['NAME']);
        $this->assertSame('Musterabteilung', $certification->getPostFormattedAddress()['ZUSATZ']);
        $this->assertSame('Musterstraße', $certification->getPostFormattedAddress()['STRASSE']);
        $this->assertSame('123', $certification->getPostFormattedAddress()['NUMMER']);
        $this->assertSame('12345', $certification->getPostFormattedAddress()['PLZ']);
        $this->assertSame('Musterdorf', $certification->getPostFormattedAddress()['STADT']);
        $this->assertSame('DEU', $certification->getPostFormattedAddress()['LAND']);
    }

    public function testStartCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetCertificationResponse.php'
        ]);
        $certification = (new CertificationApi($this->getClient($handler)))->startCertification('00000000-0000-0000-0000-000000000000');
        $this->assertSame('00000000-0000-0000-0000-000000000000', $certification->getUuid());
        $this->assertSame('TCCE', $certification->getType());
        $this->assertSame('foo bar', $certification->getAddress());
        $this->assertSame('UNKNOWN', $certification->getStatus());
        $this->assertSame('online', $certification->getExamLocation());
        $this->assertSame('1234', $certification->getHubspotDealId());
        $this->assertSame('2020-06-02T00:00:00+00:00', $certification->getExamDate()->format(\DateTimeInterface::ATOM));
        $this->assertSame('https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000', $certification->getExamUrl());
        $this->assertNull($certification->getCertificatePrintDate());
    }

    public function testUpdateCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/UpdateCertificationResponse.php'
        ]);

        $api = new CertificationApi($this->getClient($handler));
        $response = $api->updateCertification('00000000-0000-0000-0000-000000000000', $this->getTestCertificate());
        $this->assertEquals('TCCE', $response->getType());
        $this->assertEquals('2020-06-02T00:00:00+00:00', $response->getExamDate()->format(\DateTimeInterface::ATOM));
        $this->assertEquals('online', $response->getExamLocation());
        $this->assertEquals('UNKNOWN', $response->getStatus());
    }

    public function testDeleteCertification(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new CertificationApi($this->getClient($handler));
        try {
            $api->deleteCertification('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        $this->assertFalse($anExceptionWasThrown);
    }

    private function getTestCertificate(): Certification
    {
        return (new Certification())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setVersion('10.4')
            ->setType('TCCE')
            ->setAddress('foo bar')
            ->setExamLocation('online')
            ->setStatus('UNKNOWN')
            ->setExamDate(new \DateTime('2020-06-02T00:00:00+00:00'))
            ->setExamUrl('https://exam.typo3.com/examination/00000000-0000-0000-0000-000000000000');
    }

    private function getTestCertificationAddress(): Address
    {
        return (new Address())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setTitle('Home')
            ->setFirstName('Max')
            ->setLastName('Mustermann')
            ->setAdditionalAddressLine1('Musterabteilung')
            ->setCity('Musterdorf')
            ->setCountry('Germany')
            ->setStreet('Musterstraße 123')
            ->setZip('12345')
            ->setType(2);
    }
}
