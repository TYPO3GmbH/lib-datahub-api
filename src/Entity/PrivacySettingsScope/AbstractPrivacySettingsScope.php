<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity\PrivacySettingsScope;

use T3G\DatahubApiLibrary\Enum\PrivacySettingType;

abstract class AbstractPrivacySettingsScope implements \JsonSerializable
{
    public const IDENTIFIER = '';

    /**
     * @var array<string, string>
     */
    protected array $properties = [];

    public function getIdentifier(): string
    {
        if ('' === static::IDENTIFIER) {
            throw new \UnexpectedValueException(static::class . '::IDENTIFIER must not be empty');
        }

        return static::IDENTIFIER;
    }

    public function setProperty(string $name, string $value): AbstractPrivacySettingsScope
    {
        if (!PrivacySettingType::isOption($value)) {
            throw new \UnexpectedValueException('');
        }
        $this->properties[$name] = $value;

        return $this;
    }

    public function getProperty(string $name): ?string
    {
        return $this->properties[$name] ?? null;
    }

    /**
     * @return array<string, string>
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return $this->getProperties();
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
