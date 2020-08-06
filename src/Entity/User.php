<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use JsonSerializable;
use T3G\DatahubApiLibrary\Enum\CertificationStatus;

class User implements JsonSerializable
{
    private string $username;

    private ?string $email = null;

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
     * @var Certification[]
     */
    private array $certifications = [];

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

    private ?Membership $membership = null;

    public function jsonSerialize()
    {
        return [
            'username' => $this->getUserName(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'slackId' => $this->getSlackId(),
            'discordId' => $this->getDiscordId(),
        ];
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getSlackId(): ?string
    {
        return $this->slackId;
    }

    public function setSlackId(?string $slackId): self
    {
        $this->slackId = $slackId;
        return $this;
    }

    public function getDiscordId(): ?string
    {
        return $this->discordId;
    }

    public function setDiscordId(?string $discordId): self
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
     * @return User
     */
    public function setAddresses(array $addresses): self
    {
        $this->addresses = $addresses;
        return $this;
    }

    public function addAddress(Address $address): self
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
     * @return User
     */
    public function setLinks(array $links): self
    {
        $this->links = $links;
        return $this;
    }

    public function addLink(Link $link): self
    {
        $this->links[] = $link;
        return $this;
    }

    public function addOrder(Order $order): self
    {
        $this->orders[] = $order;
        return $this;
    }

    /**
     * @return array
     */
    public function getCertifications(): array
    {
        return $this->certifications;
    }

    public function getCertificationsListed(): iterable
    {
        return new \ArrayIterator(array_filter($this->certifications, static function (Certification $certification) {
            return in_array($certification->getStatus(), [CertificationStatus::PASSED, CertificationStatus::IN_PRINT], true);
        }));
    }

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
        foreach ($this->certifications as $certification) {
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
     * @param array $certifications
     * @return User
     */
    public function setCertifications(array $certifications): self
    {
        $this->certifications = $certifications;
        return $this;
    }

    public function addCertification(Certification $certification): self
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
     * @return User
     */
    public function setExamAccesses(array $examAccesses): self
    {
        $this->examAccesses = $examAccesses;
        return $this;
    }

    public function addExamAccess(ExamAccess $examAccess): self
    {
        $this->examAccesses[] = $examAccess;
        return $this;
    }

    public function addApprovedDocument(ApprovedDocument $approvedDocument): self
    {
        $this->approvedDocuments[] = $approvedDocument;
        return $this;
    }

    /**
     * @return Membership|null
     */
    public function getMembership(): ?Membership
    {
        return $this->membership;
    }

    /**
     * @param Membership|null $membership
     * @return User
     */
    public function setMembership(?Membership $membership): self
    {
        $this->membership = $membership;
        return $this;
    }

    /**
     * @param ApprovedDocument[] $approvedDocuments
     * @return User
     */
    public function setApprovedDocuments(array $approvedDocuments): self
    {
        $this->approvedDocuments = $approvedDocuments;
        return $this;
    }

    /**
     * @param Order[] $orders
     * @return User
     */
    public function setOrders(array $orders): self
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

    public function setGravatarString(?string $gravatarString): self
    {
        $this->gravatarString = $gravatarString;
        return $this;
    }

    public function getGravatarString(): string
    {
        return null !== $this->getEmail() ? md5(strtolower(trim($this->getEmail()))) : ($this->gravatarString ?? '');
    }
}
