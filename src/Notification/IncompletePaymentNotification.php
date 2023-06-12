<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Notification;

use Symfony\Component\Serializer\Annotation\Groups;

class IncompletePaymentNotification extends AbstractNotification
{
    /**
     * @Groups({"user"})
     */
    private string $company;

    /**
     * @Groups({"user"})
     */
    private string $companyTitle;

    /**
     * @Groups({"user"})
     */
    private string $subscription;

    /**
     * @Groups({"user"})
     */
    private string $stripeLink;

    public function __construct(string $company, string $companyTitle, string $subscription, string $stripeLink)
    {
        parent::__construct(sprintf('Incomplete payment for company %s', $company));
        $this->company = $company;
        $this->companyTitle = $companyTitle;
        $this->subscription = $subscription;
        $this->stripeLink = $stripeLink;
    }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'company' => $this->getCompany(),
            'companyTitle' => $this->getCompanyTitle(),
            'subscription' => $this->getSubscription(),
            'stripeLink' => $this->getStripeLink(),
        ]);
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function getCompanyTitle(): string
    {
        return $this->companyTitle;
    }

    public function getSubscription(): string
    {
        return $this->subscription;
    }

    public function getStripeLink(): string
    {
        return $this->stripeLink;
    }
}
