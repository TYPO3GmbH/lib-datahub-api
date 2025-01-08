<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Demand;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Demand\SubscriptionFilterQuery;

class SubscriptionFilterQueryTest extends TestCase
{
    public static function getQueryAsStringDataProvider(): array
    {
        return [
            'subscriptionIdentifier' => [['subscriptionIdentifier' => 'foo'], 'subscriptionIdentifier=foo'],
            'subscriptionStatus' => [['subscriptionStatus' => ['foo']], 'subscriptionStatus%5B0%5D=foo'],
            'subscriptionType' => [['subscriptionType' => ['foo']], 'subscriptionType%5B0%5D=foo'],
            'subscriptionSubType' => [['subscriptionSubType' => ['foo']], 'subscriptionSubType%5B0%5D=foo'],
            'subscriptionStatus 2' => [['subscriptionStatus' => ['foo', 'bar']], 'subscriptionStatus%5B0%5D=foo&subscriptionStatus%5B1%5D=bar'],
            'subscriptionType 2' => [['subscriptionType' => ['foo', 'bar']], 'subscriptionType%5B0%5D=foo&subscriptionType%5B1%5D=bar'],
            'subscriptionSubType 2' => [['subscriptionSubType' => ['foo', 'bar']], 'subscriptionSubType%5B0%5D=foo&subscriptionSubType%5B1%5D=bar'],
            'company' => [['company' => '00000000-0000-0000-0000-000000000000'], 'company=00000000-0000-0000-0000-000000000000'],
            'user' => [['user' => 'oelie-boelie'], 'user=oelie-boelie'],
            'all' => [[
                'subscriptionIdentifier' => 'foo1',
                'subscriptionStatus' => ['foo2'],
                'subscriptionType' => ['foo3'],
                'subscriptionSubType' => ['foo4', 'foo5'],
                'company' => '00000000-0000-0000-0000-000000000000',
                'user' => 'oelie-boelie',
            ], 'subscriptionIdentifier=foo1&subscriptionStatus%5B0%5D=foo2&subscriptionType%5B0%5D=foo3&subscriptionSubType%5B0%5D=foo4&subscriptionSubType%5B1%5D=foo5&company=00000000-0000-0000-0000-000000000000&user=oelie-boelie'],
        ];
    }

    /**
     * @dataProvider getQueryAsStringDataProvider
     */
    public function testGetQueryAsString(array $inputValues, string $expectedOutput): void
    {
        $subscriptionFilterQuery = new SubscriptionFilterQuery();
        foreach ($inputValues as $inputValue => $data) {
            $setter = 'set' . ucfirst($inputValue);
            $subscriptionFilterQuery->{$setter}($data);
        }
        self::assertSame($expectedOutput, $subscriptionFilterQuery->getQueryAsString());
        self::assertSame($expectedOutput, (string) $subscriptionFilterQuery);
    }
}
