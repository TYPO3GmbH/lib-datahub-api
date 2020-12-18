<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Api;

use GuzzleHttp\Handler\MockHandler;
use T3G\DatahubApiLibrary\Api\EmailAddressApi;
use T3G\DatahubApiLibrary\BitMask\EmailType;
use T3G\DatahubApiLibrary\Entity\EmailAddress;
use T3G\DatahubApiLibrary\Entity\UserEmail;

class EmailAddressApiTest extends AbstractApiTest
{
    public function testGetAllUserEmailAddresses(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetUserEmailAddressesListResponse.php'
        ]);
        $response = (new EmailAddressApi($this->getClient($handler)))->getAllUserEmailAddresses();
        self::assertIsArray($response);
        self::assertCount(4, $response);
        foreach ($response as $key => $item) {
            self::assertInstanceOf(UserEmail::class, $item, 'Element ' . $key . ' is not of type ' . UserEmail::class);
        }
    }

    public function testGetEmailAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEmailAddressResponse.php'
        ]);
        $response = (new EmailAddressApi($this->getClient($handler)))->getEmailAddress('00000000-0000-0000-0000-000000000000');
        self::assertSame('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertSame('max@example.com', $response->getEmail());
        self::assertSame(EmailType::PRIMARY | EmailType::BILLING | EmailType::VOTING, $response->getType());
        self::assertNull($response->getOptIn());
    }

    public function testUpdateEmailAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/GetEmailAddressResponse.php'
        ]);
        $response = (new EmailAddressApi($this->getClient($handler)))->updateEmailAddress('00000000-0000-0000-0000-000000000000', $this->getEmailAddress());
        self::assertSame('00000000-0000-0000-0000-000000000000', $response->getUuid());
        self::assertSame('max@example.com', $response->getEmail());
        self::assertSame(EmailType::PRIMARY | EmailType::BILLING | EmailType::VOTING, $response->getType());
        self::assertNull($response->getOptIn());
    }

    public function testDeleteEmailAddress(): void
    {
        $handler = new MockHandler([
            require __DIR__ . '/../Fixtures/NoContentResponse.php'
        ]);
        $api = new EmailAddressApi($this->getClient($handler));
        try {
            $api->deleteEmailAddress('00000000-0000-0000-0000-000000000000');
            $anExceptionWasThrown = false;
        } catch (\Exception $e) {
            $anExceptionWasThrown = true;
        }
        self::assertFalse($anExceptionWasThrown);
    }

    private function getEmailAddress(): EmailAddress
    {
        return (new EmailAddress())
            ->setUuid('00000000-0000-0000-0000-000000000000')
            ->setEmail('max@example.com')
            ->setType(EmailType::PRIMARY | EmailType::BILLING | EmailType::VOTING);
    }
}
