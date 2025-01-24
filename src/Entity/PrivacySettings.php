<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use T3G\DatahubApiLibrary\Entity\PrivacySettingsScope\AbstractPrivacySettingsScope;

class PrivacySettings implements \JsonSerializable
{
    /**
     * @var array<string, AbstractPrivacySettingsScope>
     */
    private array $scopes;

    public function __construct(AbstractPrivacySettingsScope ...$scopes)
    {
        foreach ($scopes as $scope) {
            $this->scopes[$scope->getIdentifier()] = $scope;
        }
    }

    public function addScope(AbstractPrivacySettingsScope $scope): PrivacySettings
    {
        $this->scopes[$scope->getIdentifier()] = $scope;

        return $this;
    }

    public function getScope(string $identifier): ?AbstractPrivacySettingsScope
    {
        return $this->scopes[$identifier] ?? null;
    }

    /**
     * @return array<string, AbstractPrivacySettingsScope>
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function getProperty(string $identifier): ?string
    {
        if (!str_contains($identifier, '.')) {
            throw new \InvalidArgumentException(sprintf('Identifier must be in the format {scope}.{property}. "%s" given.', $identifier));
        }

        [$scopeIdentifier, $property] = explode('.', $identifier);

        $scope = $this->getScope($scopeIdentifier);

        return null !== $scope ? $scope->getProperty($property) : null;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function toArray(): array
    {
        $privacySettings = [];
        foreach ($this->scopes as $scope) {
            $privacySettings[$scope->getIdentifier()] = $scope->toArray();
        }

        return $privacySettings;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
