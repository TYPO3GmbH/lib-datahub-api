<?php

declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use T3G\DatahubApiLibrary\BitMask\EmailType;
use T3G\DatahubApiLibrary\Enum\CertificationStatus;
use T3G\DatahubApiLibrary\Notification\NotificationInterface;

class User implements \JsonSerializable
{
    private string $username;
    private ?string $password = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $phone = null;
    private ?string $slackId = null;
    private ?string $discordId = null;
    private ?string $gravatarString = null;

    /**
     * @var Address[]
     */
    private array $addresses = [];

    /**
     * @var Link[]
     */
    private array $links = [];

    /**
     * @var EmailAddress[]
     */
    private array $emailAddresses = [];

    /**
     * @var Certification[]
     */
    private array $certifications = [];

    /**
     * @var Company[]
     */
    private array $companies = [];

    /**
     * @var ExamAccess[]
     */
    private array $examAccesses = [];

    /**
     * @var ApprovedDocument[]
     */
    private array $approvedDocuments = [];

    /**
     * @var Order[]
     */
    private array $orders = [];

    /**
     * @var Subscription[]
     */
    private array $subscriptions = [];

    /**
     * @var NotificationInterface[]
     */
    private array $notifications = [];

    /**
     * @var VoucherCode[]
     */
    private array $voucherCodes = [];
    private ?Subscription $membership = null;

    /**
     * @var EltsPlan[]
     */
    private array $eltsPlans = [];

    /**
     * @var EltsAccessToken[]
     */
    private array $eltsAccessTokens = [];

    /**
     * @var EltsGitPublicKey[]
     */
    private array $eltsGitPublicKeys = [];

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'username' => $this->getUserName(),
            'password' => $this->getPassword(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' => $this->getPrimaryEmail(),
            'phone' => $this->getPhone(),
            'slackId' => $this->getSlackId(),
            'discordId' => $this->getDiscordId(),
        ];
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getPrimaryEmail(bool $onlyOptIn = true): ?string
    {
        return $this->getEmailByType(EmailType::PRIMARY, $onlyOptIn);
    }

    public function getBillingEmail(bool $onlyOptIn = true): ?string
    {
        return $this->getEmailByType(EmailType::BILLING, $onlyOptIn);
    }

    public function getVotingEmail(bool $onlyOptIn = true): ?string
    {
        return $this->getEmailByType(EmailType::VOTING, $onlyOptIn);
    }

    public function getEmailByType(int $type, bool $onlyOptIn = true): ?string
    {
        foreach ($this->getEmailAddresses() as $address) {
            if ($type === ($address->getType() & $type) && (null !== $address->getOptIn() || !$onlyOptIn)) {
                return $address->getEmail();
            }
        }

        return null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSlackId(): ?string
    {
        return $this->slackId;
    }

    public function setSlackId(?string $slackId): static
    {
        $this->slackId = $slackId;

        return $this;
    }

    public function getDiscordId(): ?string
    {
        return $this->discordId;
    }

    public function setDiscordId(?string $discordId): static
    {
        $this->discordId = $discordId;

        return $this;
    }

    /**
     * @return ApprovedDocument[]
     */
    public function getApprovedDocuments(): array
    {
        return $this->approvedDocuments;
    }

    /**
     * @return Order[]
     */
    public function getOrders(): array
    {
        return $this->orders;
    }

    /**
     * @param bool $ascending Set true for ascending order, false for descending order
     *
     * @return Order[]
     */
    public function getOrdersSortedByTime(bool $ascending = true): array
    {
        $o = $this->orders;
        usort($o, static function (Order $a, Order $b) {
            if ($a->getCreatedAt()->getTimestamp() === $b->getCreatedAt()->getTimestamp()) {
                return 0;
            }

            return $a->getCreatedAt() < $b->getCreatedAt() ? -1 : 1;
        });

        return $ascending ? $o : array_reverse($o);
    }

    /**
     * @return Address[]
     */
    public function getAddresses(): array
    {
        return $this->addresses;
    }

    /**
     * @param Address[] $addresses
     */
    public function setAddresses(array $addresses): static
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function addAddress(Address $address): static
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * @return Link[]
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param Link[] $links
     */
    public function setLinks(array $links): static
    {
        $this->links = $links;

        return $this;
    }

    public function addLink(Link $link): static
    {
        $this->links[] = $link;

        return $this;
    }

    /**
     * @return EmailAddress[]
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses;
    }

    /**
     * @param EmailAddress[] $emailAddresses
     */
    public function setEmailAddresses(array $emailAddresses): static
    {
        $this->emailAddresses = $emailAddresses;

        return $this;
    }

    public function addEmailAddress(EmailAddress $emailAddress): static
    {
        $this->emailAddresses[] = $emailAddress;

        return $this;
    }

    public function addOrder(Order $order): static
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * @return NotificationInterface[]
     */
    public function getNotifications(): array
    {
        return $this->notifications;
    }

    /**
     * @param NotificationInterface[] $notifications
     */
    public function setNotifications(array $notifications): static
    {
        $this->notifications = $notifications;

        return $this;
    }

    public function addNotification(NotificationInterface $notification): static
    {
        $this->notifications[] = $notification;

        return $this;
    }
    /**
     * @return Subscription[]
     */
    public function getSubscriptions(): array
    {
        return $this->subscriptions;
    }

    /**
     * @param Subscription[] $subscriptions
     */
    public function setSubscriptions(array $subscriptions): static
    {
        $this->subscriptions = $subscriptions;

        return $this;
    }

    public function addSubscription(Subscription $subscription): static
    {
        $this->subscriptions[] = $subscription;

        return $this;
    }

    /**
     * @return array<int, Company>
     */
    public function getCompanies(): array
    {
        return $this->companies;
    }

    /**
     * @param array<int, Company> $companies
     */
    public function setCompanies(array $companies): static
    {
        $this->companies = $companies;

        return $this;
    }

    public function addCompany(Company $company): static
    {
        $this->companies[] = $company;

        return $this;
    }

    /**
     * @return Certification[]
     */
    public function getCertifications(): array
    {
        return $this->certifications;
    }

    /**
     * @return iterable<Certification>
     */
    public function getCertificationsListed(): iterable
    {
        return new \ArrayIterator(array_filter($this->certifications, static function (Certification $certification) {
            return in_array($certification->getStatus(), [CertificationStatus::PASSED, CertificationStatus::IN_PRINT], true);
        }));
    }

    /**
     * @return iterable<Certification>
     */
    public function getCertificationsNotListed(): iterable
    {
        return new \ArrayIterator(array_filter($this->certifications, static function (Certification $certification) {
            return !in_array($certification->getStatus(), [CertificationStatus::PASSED, CertificationStatus::IN_PRINT], true);
        }));
    }

    /**
     * @return Certification[]
     */
    public function getActiveCertifications(): array
    {
        $active = [];
        foreach ($this->getCertificationsListed() as $certification) {
            if ($certification->getValidUntil() < new \DateTime()) {
                continue;
            }
            if (isset($active[$certification->getType()]) && $certification->getValidUntil() < $active[$certification->getType()]->getValidUntil()) {
                continue;
            }
            $active[$certification->getType()] = $certification;
        }
        ksort($active);

        return $active;
    }

    /**
     * @param Certification[] $certifications
     */
    public function setCertifications(array $certifications): static
    {
        $this->certifications = $certifications;

        return $this;
    }

    public function addCertification(Certification $certification): static
    {
        $this->certifications[] = $certification;

        return $this;
    }

    /**
     * @return ExamAccess[]
     */
    public function getExamAccesses(): array
    {
        return $this->examAccesses;
    }

    /**
     * @param ExamAccess[] $examAccesses
     */
    public function setExamAccesses(array $examAccesses): static
    {
        $this->examAccesses = $examAccesses;

        return $this;
    }

    public function addExamAccess(ExamAccess $examAccess): static
    {
        $this->examAccesses[] = $examAccess;

        return $this;
    }

    public function addApprovedDocument(ApprovedDocument $approvedDocument): static
    {
        $this->approvedDocuments[] = $approvedDocument;

        return $this;
    }

    /**
     * @return Subscription|null
     */
    public function getMembership(): ?Subscription
    {
        return $this->membership;
    }

    /**
     * @param Subscription|null $membership
     */
    public function setMembership(?Subscription $membership): static
    {
        $this->membership = $membership;

        return $this;
    }

    /**
     * @param ApprovedDocument[] $approvedDocuments
     */
    public function setApprovedDocuments(array $approvedDocuments): static
    {
        $this->approvedDocuments = $approvedDocuments;

        return $this;
    }

    /**
     * @param Order[] $orders
     */
    public function setOrders(array $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * @return Address[]
     */
    public function getInvoiceAddresses(): iterable
    {
        return new \ArrayIterator(array_filter($this->addresses, static function (Address $address) {
            return $address->isInvoiceAddress();
        }));
    }

    /**
     * @return Address[]
     */
    public function getPostalAddresses(): iterable
    {
        return new \ArrayIterator(array_filter($this->addresses, static function (Address $address) {
            return $address->isPostalAddress();
        }));
    }

    /**
     * @return Address[]
     */
    public function getDeliveryAddresses(): iterable
    {
        return new \ArrayIterator(array_filter($this->addresses, static function (Address $address) {
            return $address->isDeliveryAddress();
        }));
    }

    /**
     * @return Address[]
     */
    public function getLocationAddresses(): iterable
    {
        return new \ArrayIterator(array_filter($this->addresses, static function (Address $address) {
            return $address->isLocationAddress();
        }));
    }

    public function setGravatarString(?string $gravatarString): static
    {
        $this->gravatarString = $gravatarString;

        return $this;
    }

    public function getGravatarString(): string
    {
        return null !== $this->getPrimaryEmail() ? md5(strtolower(trim($this->getPrimaryEmail()))) : ($this->gravatarString ?? '');
    }

    /**
     * @return VoucherCode[]
     */
    public function getVoucherCodes(): array
    {
        return $this->voucherCodes;
    }

    /**
     * @param VoucherCode[] $voucherCodes
     */
    public function setVoucherCodes(array $voucherCodes): static
    {
        $this->voucherCodes = $voucherCodes;

        return $this;
    }

    public function addVoucherCode(VoucherCode $voucherCode): static
    {
        $this->voucherCodes[] = $voucherCode;

        return $this;
    }

    /**
     * @return EltsPlan[]
     */
    public function getEltsPlans(): array
    {
        return $this->eltsPlans;
    }

    /**
     * @param EltsPlan[] $eltsPlans
     */
    public function setEltsPlans(array $eltsPlans): static
    {
        $this->eltsPlans = $eltsPlans;

        return $this;
    }

    public function addEltsPlan(EltsPlan $eltsPlan): static
    {
        $this->eltsPlans[] = $eltsPlan;

        return $this;
    }

    /**
     * @return EltsAccessToken[]
     */
    public function getEltsAccessTokens(): array
    {
        return $this->eltsAccessTokens;
    }

    /**
     * @param EltsAccessToken[] $eltsAccessTokens
     */
    public function setEltsAccessTokens(array $eltsAccessTokens): static
    {
        $this->eltsAccessTokens = $eltsAccessTokens;

        return $this;
    }

    public function addEltsAccessToken(EltsAccessToken $eltsAccessToken): static
    {
        $this->eltsAccessTokens[] = $eltsAccessToken;

        return $this;
    }

    /**
     * @return EltsGitPublicKey[]
     */
    public function getEltsGitPublicKey(): array
    {
        return $this->eltsGitPublicKeys;
    }

    /**
     * @param EltsGitPublicKey[] $eltsGitPublicKeys
     */
    public function setEltsGitPublicKeys(array $eltsGitPublicKeys): static
    {
        $this->eltsGitPublicKeys = $eltsGitPublicKeys;

        return $this;
    }

    public function addEltsGitPublicKey(EltsGitPublicKey $eltsGitPublicKey): static
    {
        $this->eltsGitPublicKeys[] = $eltsGitPublicKey;

        return $this;
    }
}
