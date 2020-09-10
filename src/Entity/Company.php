<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use JsonSerializable;
use T3G\DatahubApiLibrary\Enum\CompanyType;
use T3G\DatahubApiLibrary\Enum\EmployeeRole;

class Company implements JsonSerializable
{
    private string $uuid;
    private string $companyType = CompanyType::AGENCY;
    private string $title;
    private ?string $slug = null;
    private string $email;
    private ?string $vatId = null;
    private ?string $city = null;
    private ?string $country = null;

    /**
     * @var Address[]
     */
    private array $addresses = [];

    /**
     * @var Employee[]
     */
    private array $employees = [];

    /**
     * @var Order[]
     */
    private array $orders = [];

    /**
     * @var Subscription[]
     */
    private array $subscriptions = [];

    private ?Address $headquarter = null;
    private ?Membership $membership = null;
    private ?string $domain = null;
    private ?string $backlink = null;

    /**
     * @var string[]
     */
    private array $mapLocations = [];
    private ?string $teaserText = null;
    private ?string $profilePageText = null;
    private ?string $contactFormAddress = null;
    private ?string $photo = null;
    private ?string $logo = null;

    public function jsonSerialize()
    {
        return [
            'companyType' => $this->getCompanyType(),
            'title' => $this->getTitle(),
            'slug' => $this->getSlug(),
            'email' => $this->getEmail(),
            'vatId' => $this->getVatId(),
            'city' => $this->getCity(),
            'country' => $this->getCountry(),
            'domain' => $this->getDomain(),
            'backlink' => $this->getBacklink(),
            'mapLocations' => $this->getMapLocations(),
            'teaserText' => $this->getTeaserText(),
            'profilePageText' => $this->getProfilePageText(),
            'contactFormAddress' => $this->getContactFormAddress(),
            'photo' => $this->getPhoto(),
            'logo' => $this->getLogo(),
            'headquarter' => $this->getHeadquarter(),
        ];
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getCompanyType(): string
    {
        return $this->companyType;
    }

    public function setCompanyType(string $companyType): self
    {
        $this->companyType = $companyType;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getVatId(): ?string
    {
        return $this->vatId;
    }

    public function setVatId(?string $vatId): self
    {
        $this->vatId = $vatId;
        return $this;
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }

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

    public function getEmployees(): array
    {
        return $this->employees;
    }

    public function setEmployees(array $employees): self
    {
        $this->employees = $employees;
        return $this;
    }

    public function getEmployee(string $username): ?Employee
    {
        foreach ($this->employees as $employee) {
            if ($username === $employee->getUser()->getUserName()) {
                return $employee;
            }
        }

        return null;
    }

    public function getEmployeeByUuid(string $uuid): ?Employee
    {
        foreach ($this->employees as $employee) {
            if ($uuid === $employee->getUuid()) {
                return $employee;
            }
        }

        return null;
    }

    public function addEmployee(Employee $employee): self
    {
        $this->employees[] = $employee;

        return $this;
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
     * @param Order[] $orders
     * @return Company
     */
    public function setOrders(array $orders): self
    {
        $this->orders = $orders;
        return $this;
    }

    public function addOrder(Order $order): self
    {
        $this->orders[] = $order;
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
     * @return Company
     */
    public function setSubscriptions(array $subscriptions): self
    {
        $this->subscriptions = $subscriptions;
        return $this;
    }

    public function addSubscription(Subscription $subscription): self
    {
        $this->subscriptions[] = $subscription;
        return $this;
    }

    public function getMembership(): ?Membership
    {
        return $this->membership;
    }

    public function setMembership(?Membership $membership): self
    {
        $this->membership = $membership;
        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    /**
     * @param string $username
     * @param string $role
     * @return bool
     * @deprecated since 24.06.2020, will be remove after 24.12.2020. Use employeeHasRole(), isEmployee(), isManager() or isOwner() instead
     */
    public function hasRole(string $username, string $role): bool
    {
        trigger_error(__METHOD__ . ' has been marked as deprecated and will be removed after 24.12.2020. Use employeeHasRole(), isEmployee(), isManager() or isOwner() instead', E_USER_DEPRECATED);
        return $this->employeeHasRole($username, $role);
    }

    public function isEmployee(string $username): bool
    {
        return $this->employeeHasRole($username, EmployeeRole::EMPLOYEE);
    }

    public function isManager(string $username): bool
    {
        return $this->employeeHasRole($username, EmployeeRole::MANAGER);
    }

    public function isOwner(string $username): bool
    {
        return $this->employeeHasRole($username, EmployeeRole::OWNER);
    }

    public function employeeHasRole(string $username, string $role): bool
    {
        foreach ($this->employees as $employee) {
            if ($role === $employee->getRole() && $username === $employee->getUser()->getUsername()) {
                return true;
            }
        }
        return false;
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

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getBacklink(): ?string
    {
        return $this->backlink;
    }

    public function setBacklink(?string $backlink): self
    {
        $this->backlink = $backlink;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getMapLocations(): array
    {
        return $this->mapLocations;
    }

    /**
     * @param string[] $mapLocations
     * @return $this
     */
    public function setMapLocations(array $mapLocations): self
    {
        $this->mapLocations = $mapLocations;
        return $this;
    }

    public function getTeaserText(): ?string
    {
        return $this->teaserText;
    }

    public function setTeaserText(?string $teaserText): self
    {
        $this->teaserText = $teaserText;
        return $this;
    }

    public function getProfilePageText(): ?string
    {
        return $this->profilePageText;
    }

    public function setProfilePageText(?string $profilePageText): self
    {
        $this->profilePageText = $profilePageText;
        return $this;
    }

    public function getContactFormAddress(): ?string
    {
        return $this->contactFormAddress;
    }

    public function setContactFormAddress(?string $contactFormAddress): self
    {
        $this->contactFormAddress = $contactFormAddress;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;
        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;
        return $this;
    }

    public function getHeadquarter(): ?Address
    {
        return $this->headquarter;
    }

    public function setHeadquarter(?Address $headquarter): self
    {
        $this->headquarter = $headquarter;
        return $this;
    }
}
