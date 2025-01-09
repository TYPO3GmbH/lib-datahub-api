<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Tests\Entity;

use PHPUnit\Framework\TestCase;
use T3G\DatahubApiLibrary\Factory\PrivacySettingsFactory;

class PrivacySettingsTest extends TestCase
{
    public function testToArray(): void
    {
        $privacySettings = PrivacySettingsFactory::default();
        $arrayRepresentation = $privacySettings->toArray();

        foreach ($privacySettings->getScopes() as $scope) {
            $propertyNames = array_keys($scope->getProperties());

            foreach ($propertyNames as $propertyName) {
                self::assertSame(
                    $scope->getProperty($propertyName),
                    $arrayRepresentation[$scope->getIdentifier()][$propertyName]
                );
            }
        }
    }

    public function testPropertyAccessWithDotSyntax(): void
    {
        $privacySettings = PrivacySettingsFactory::default();

        self::assertSame('public', $privacySettings->getProperty('public-profile.bio'));
    }
}
