<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use JsonSerializable;

class EltsInstance implements JsonSerializable
{
    private string $uuid;
    private string $name;

    /**
     * @var User[]
     */
    private array $technicalContacts = [];

    /**
     * @var SimpleTechnicalContact[]
     */
    private array $simpleTechnicalContacts = [];

    /**
     * @return array{name: string, technicalContacts: string[]}
     */
    public function jsonSerialize(): array
    {
        return [
            'name' => $this->getName(),
            'technicalContacts' => array_unique(array_map(static function (User $user) {
                return $user->getUsername();
            }, $this->getTechnicalContacts())),
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return User[]
     */
    public function getTechnicalContacts(): array
    {
        return $this->technicalContacts;
    }

    /**
     * @param User[] $technicalContacts
     * @return self
     */
    public function setTechnicalContacts(array $technicalContacts): self
    {
        $this->technicalContacts = $technicalContacts;
        return $this;
    }

    public function addTechnicalContact(User $technicalContacts): self
    {
        $this->technicalContacts[] = $technicalContacts;
        return $this;
    }

    /**
     * @return SimpleTechnicalContact[]
     */
    public function getSimpleTechnicalContacts(): array
    {
        return $this->simpleTechnicalContacts;
    }

    /**
     * @param SimpleTechnicalContact[] $simpleTechnicalContacts
     * @return self
     */
    public function setSimpleTechnicalContacts(array $simpleTechnicalContacts): self
    {
        $this->simpleTechnicalContacts = $simpleTechnicalContacts;
        return $this;
    }

    public function addSimpleTechnicalContact(SimpleTechnicalContact $simpleTechnicalContact): self
    {
        $this->simpleTechnicalContacts[] = $simpleTechnicalContact;
        return $this;
    }
}
