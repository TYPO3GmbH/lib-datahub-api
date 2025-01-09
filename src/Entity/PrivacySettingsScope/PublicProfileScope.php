<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity\PrivacySettingsScope;

use T3G\DatahubApiLibrary\Enum\PrivacySettingType;

/**
 * @codeCoverageIgnore No need to test this...
 */
class PublicProfileScope extends AbstractPrivacySettingsScope
{
    public const IDENTIFIER = 'public-profile';

    /** {@inheritdoc} */
    protected array $properties = [
        'firstName' => PrivacySettingType::PRIVATE,
        'lastName' => PrivacySettingType::PRIVATE,
        'title' => PrivacySettingType::PUBLIC,
        'email' => PrivacySettingType::PRIVATE,
        'slackId' => PrivacySettingType::LOGGED_IN,
        'discordId' => PrivacySettingType::LOGGED_IN,
        'bio' => PrivacySettingType::PUBLIC,
        'avatar' => PrivacySettingType::LOGGED_IN,
        'links' => PrivacySettingType::LOGGED_IN,
        'certifications' => PrivacySettingType::PUBLIC,
        'membership' => PrivacySettingType::PUBLIC,
    ];
}
