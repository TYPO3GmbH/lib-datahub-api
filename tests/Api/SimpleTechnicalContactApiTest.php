<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\SimpleTechnicalContactApi;
use T3G\DatahubApiLibrary\Entity\SimpleTechnicalContact;

class SimpleTechnicalContactApiTest extends AbstractApiTest
{
    public function testCreateSimpleTechnicalContactForInstance(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSimpleTechnicalContactResponse.php'
        ]);

        $simpleTechnicalContact = $this->getTestSimpleTechnicalContactForGet();
        $response = (new SimpleTechnicalContactApi($this->getClient($handler)))
            ->createSimpleTechnicalContactForInstance('d209090d-be9e-4034-82e8-7a7ebb5b776c', $simpleTechnicalContact);

        self::assertEquals($simpleTechnicalContact->getUuid(), $response->getUuid());
        self::assertEquals($simpleTechnicalContact->getFirstName(), $response->getFirstName());
        self::assertEquals($simpleTechnicalContact->getLastName(), $response->getLastName());
        self::assertEquals($simpleTechnicalContact->getEmail(), $response->getEmail());
    }

    public function testGetSimpleTechnicalContact(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetSimpleTechnicalContactResponse.php'
        ]);

        $simpleTechnicalContact = $this->getTestSimpleTechnicalContactForGet();
        $response = (new SimpleTechnicalContactApi($this->getClient($handler)))
            ->getSimpleTechnicalContact('d209090d-be9e-4034-82e8-7a7ebb5b776c');

        self::assertEquals($simpleTechnicalContact->getUuid(), $response->getUuid());
        self::assertEquals($simpleTechnicalContact->getFirstName(), $response->getFirstName());
        self::assertEquals($simpleTechnicalContact->getLastName(), $response->getLastName());
        self::assertEquals($simpleTechnicalContact->getEmail(), $response->getEmail());
    }

    public function testUpdateSimpleTechnicalContact(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/PutSimpleTechnicalContactResponse.php'
        ]);

        $simpleTechnicalContact = $this->getTestSimpleTechnicalContactForPut();
        $response = (new SimpleTechnicalContactApi($this->getClient($handler)))
            ->updateSimpleTechnicalContact('d209090d-be9e-4034-82e8-7a7ebb5b776c', $simpleTechnicalContact);

        self::assertEquals('d209090d-be9e-4034-82e8-7a7ebb5b776c', $response->getUuid());
        self::assertEquals($simpleTechnicalContact->getFirstName(), $response->getFirstName());
        self::assertEquals($simpleTechnicalContact->getLastName(), $response->getLastName());
        self::assertEquals($simpleTechnicalContact->getEmail(), $response->getEmail());
    }

    public function testDeleteSimpleTechnicalContact(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);

        $api = new SimpleTechnicalContactApi($this->getClient($handler));
        try {
            $api->deleteSimpleTechnicalContact('d209090d-be9e-4034-82e8-7a7ebb5b776c');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }

        self::assertFalse($anExceptionWasThrown);
    }

    private function getTestSimpleTechnicalContactForGet(): SimpleTechnicalContact
    {
        return (new SimpleTechnicalContact())
            ->setUuid('d209090d-be9e-4034-82e8-7a7ebb5b776c')
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setEmail('johndoe@example.com');
    }

    private function getTestSimpleTechnicalContactForPut(): SimpleTechnicalContact
    {
        return (new SimpleTechnicalContact())
            ->setFirstName('Joanne')
            ->setLastName('Doe')
            ->setEmail('joannedoe@example.com');
    }
}
