<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\TechnicalContactApi;
use T3G\DatahubApiLibrary\Dto\CreateTechnicalContactDto;
use T3G\DatahubApiLibrary\Entity\TechnicalContact;

class TechnicalContactApiTest extends AbstractApiTestCase
{
    public function testCreateTechnicalContactForInstance(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/CreateTechnicalContactResponse.php',
        ]);

        $technicalContact = new CreateTechnicalContactDto();
        $technicalContact->firstName = 'Markus';
        $technicalContact->lastName = 'Miller';
        $technicalContact->email = 'markus.miller@typo3.com';
        $technicalContact->instance = 'd209090d-be9e-4034-82e8-7a7ebb5b776c';
        $response = (new TechnicalContactApi($this->getClient($handler)))
            ->createTechnicalContact($technicalContact);

        self::assertEquals($technicalContact->firstName, $response->getFirstName());
        self::assertEquals($technicalContact->lastName, $response->getLastName());
        self::assertEquals($technicalContact->email, $response->getEmail());
    }

    public function testGetTechnicalContact(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetTechnicalContactResponse.php',
        ]);

        $technicalContact = $this->getTestTechnicalContactForGet();
        $response = (new TechnicalContactApi($this->getClient($handler)))
            ->getTechnicalContact('d209090d-be9e-4034-82e8-7a7ebb5b776c');

        self::assertEquals($technicalContact->getUuid(), $response->getUuid());
        self::assertEquals($technicalContact->getFirstName(), $response->getFirstName());
        self::assertEquals($technicalContact->getLastName(), $response->getLastName());
        self::assertEquals($technicalContact->getEmail(), $response->getEmail());
        self::assertEquals($technicalContact->getAccepted(), $response->getAccepted());
    }

    public function testConfirmTechnicalContact(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/ConfirmTechnicalContactResponse.php',
        ]);

        $technicalContact = $this->getTestTechnicalContactForConfirm();
        $response = (new TechnicalContactApi($this->getClient($handler)))
            ->confirmTechnicalContact('d209090d-be9e-4034-82e8-7a7ebb5b776c');

        self::assertEquals('d209090d-be9e-4034-82e8-7a7ebb5b776c', $response->getUuid());
        self::assertEquals($technicalContact->getFirstName(), $response->getFirstName());
        self::assertEquals($technicalContact->getLastName(), $response->getLastName());
        self::assertEquals($technicalContact->getEmail(), $response->getEmail());
    }

    public function testDeleteTechnicalContact(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php',
        ]);

        $api = new TechnicalContactApi($this->getClient($handler));
        try {
            $api->deleteTechnicalContact('d209090d-be9e-4034-82e8-7a7ebb5b776c');
            $anExceptionWasThrown = false;
        } catch (\Exception) {
            $anExceptionWasThrown = true;
        }

        self::assertFalse($anExceptionWasThrown);
    }

    private function getTestTechnicalContactForGet(): TechnicalContact
    {
        return (new TechnicalContact())
            ->setUuid('d209090d-be9e-4034-82e8-7a7ebb5b776c')
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setEmail('johndoe@example.com')
            ->setAccepted(false);
    }

    private function getTestTechnicalContactForConfirm(): TechnicalContact
    {
        return (new TechnicalContact())
            ->setUuid('d209090d-be9e-4034-82e8-7a7ebb5b776c')
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setEmail('johndoe@example.com')
            ->setAccepted(true);
    }
}
