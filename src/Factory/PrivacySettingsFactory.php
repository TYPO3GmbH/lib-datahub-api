<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Factory;

use T3G\DatahubApiLibrary\Entity\PrivacySettings;
use T3G\DatahubApiLibrary\Entity\PrivacySettingsScope\PublicProfileScope;

/**
 * @extends AbstractFactory<PrivacySettings>
 */
class PrivacySettingsFactory extends AbstractFactory
{
    /**
     * @param array<string, array<string, string>> $data
     *
     * @return PrivacySettings
     */
    public static function fromArray(array $data): PrivacySettings
    {
        $privacySettings = self::default();

        foreach ($data as $scopeIdentifier => $scopeData) {
            $scope = $privacySettings->getScope($scopeIdentifier);
            if (null === $scope) {
                // ignore scopes without defaults
                continue;
            }
            foreach ($scopeData as $propertyName => $propertyValue) {
                $scope->setProperty($propertyName, $propertyValue);
            }
            $privacySettings->addScope($scope);
        }

        return $privacySettings;
    }

    public static function default(): PrivacySettings
    {
        return new PrivacySettings(new PublicProfileScope());
    }
}
