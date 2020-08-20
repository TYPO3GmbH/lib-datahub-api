<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Enum;

/**
 * @codeCoverageIgnore No need to test this ...
 */
final class WebHookType extends AbstractEnum
{
    public const ADDRESS_CHANGED = 'address_changed';
    public const COMPANY_CHANGED = 'company_changed';
    public const COMPANY_CREATED = 'company_created';
    public const COMPANY_DELETED = 'company_deleted';
    public const COMPANY_ADDRESS_CREATED = 'company_address_created';
    public const COMPANY_ADDRESS_DELETED = 'company_address_deleted';
    public const USER_CHANGED = 'user_changed';
    public const USER_DELETED = 'user_deleted';
    public const USER_DELETE_STARTED = 'user_delete_started';
    public const USER_ADDRESS_CREATED = 'user_address_created';
    public const USER_ADDRESS_DELETED = 'user_address_deleted';
    public const CERTIFICATION_CREATION_SUCCESS = 'certification_creation_success';
    public const CERTIFICATION_CREATION_FAILED = 'certification_creation_failed';
    public const EXAM_ACCESS_CREATED = 'exam_access_created';
    public const EXAM_ACCESS_UPDATED = 'exam_access_updated';
    public const EXAM_RESULTS_ARRIVED = 'exam_results_arrived';
    public const EXAM_STARTED = 'exam_started';
    public const PROCTORING_RESULTS_ARRIVED = 'proctoring_results_arrived';
    public const ORDER_CREATED = 'order_created';
    public const ORDER_UPDATED = 'order_updated';
    public const ORDER_DELETED = 'order_deleted';
    public const SUBSCRIPTION_CREATED = 'subscription_created';
    public const SUBSCRIPTION_UPDATED = 'subscription_updated';
    public const SUBSCRIPTION_DELETED = 'subscription_deleted';

    protected static array $optionNames = [
        self::ADDRESS_CHANGED => 'Address record has been changed',
        self::COMPANY_CHANGED => 'Company record has been changed',
        self::COMPANY_CREATED => 'Company record has been created',
        self::COMPANY_DELETED => 'Company record has been deleted',
        self::COMPANY_ADDRESS_CREATED => 'Company address record has been created',
        self::COMPANY_ADDRESS_DELETED => 'Company address record has been deleted',
        self::USER_CHANGED => 'User record has been changed',
        self::USER_DELETED => 'User record has been deleted',
        self::USER_DELETE_STARTED => 'User record delete process has been started',
        self::USER_ADDRESS_CREATED => 'User address record has been created',
        self::USER_ADDRESS_DELETED => 'User address record has been deleted',
        self::CERTIFICATION_CREATION_SUCCESS => 'Certification has been created successfully and is ready to the test-taker',
        self::CERTIFICATION_CREATION_FAILED => 'Certification has been created but there is something wrong. Check the history and logs for details.',
        self::EXAM_RESULTS_ARRIVED => 'The final exam results arrived.',
        self::EXAM_ACCESS_CREATED => 'An exam access record has been created',
        self::EXAM_ACCESS_UPDATED => 'An exam access record has been updated',
        self::EXAM_STARTED => 'An exam has started, a certification record was updated.',
        self::PROCTORING_RESULTS_ARRIVED => 'The final proctoring results arrived.',
        self::ORDER_CREATED => 'Order record has been created',
        self::ORDER_UPDATED => 'Order record has been changed',
        self::ORDER_DELETED => 'Order record has been deleted',
        self::SUBSCRIPTION_CREATED => 'Subscription record has been created',
        self::SUBSCRIPTION_UPDATED => 'Subscription record has been changed',
        self::SUBSCRIPTION_DELETED => 'Subscription record has been deleted',
    ];
}
