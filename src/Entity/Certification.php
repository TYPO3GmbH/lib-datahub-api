<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use DateTimeInterface;
use JsonSerializable;
use T3G\DatahubApiLibrary\Enum\CertificationProctoringApprovalStatus;
use T3G\DatahubApiLibrary\Enum\CertificationTestResult;
use T3G\DatahubApiLibrary\Enum\CertificationType;
use T3G\DatahubApiLibrary\Enum\CertificationVersion;

class Certification implements JsonSerializable
{
    private string $uuid = '';
    private string $type = '';
    private string $version = '';
    private array $user = [];
    private string $status = '';
    private string $examLocation = '';
    private ?DateTimeInterface $examDate = null;
    private ?string $proctoringLink = null;
    private string $address = '';
    private ?string $examUrl = null;
    private ?string $examAccessCode = null;
    private ?string $examProctoringInstructions = null;
    private ?DateTimeInterface $examStartDate = null;
    private ?DateTimeInterface $examEndDate = null;
    private ?int $examDuration = null;
    private ?string $history = null;
    private string $examTestResult = CertificationTestResult::NO_RESULT;
    private ?string $proctoringStatus = null;
    private ?DateTimeInterface $certificatePrintDate = null;
    private ?int $incidents = 0;
    private string $proctoringApproval = CertificationProctoringApprovalStatus::UNKNOWN;
    private ?string $hubspotDealId = null;
    private ?\DateTimeInterface $validUntil = null;

    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'version' => $this->getVersion(),
            'examLocation' => $this->getExamLocation(),
            'examDate' => $this->formatDateIfGiven($this->getExamDate()),
            'proctoringLink' => $this->getProctoringLink(),
            'address' => $this->getAddress(),
            'examUrl' => $this->getExamUrl(),
            'examAccessCode' => $this->getExamAccessCode(),
            'examProctoringInstructions' => $this->getExamProctoringInstructions(),
            'examStartDate' => $this->formatDateIfGiven($this->getExamStartDate()),
            'examEndDate' => $this->formatDateIfGiven($this->getExamEndDate()),
            'examDuration' => $this->getExamDuration(),
            'examTestResult' => $this->getExamTestResult(),
            'certificatePrintDate' => $this->formatDateIfGiven($this->getCertificatePrintDate()),
            'proctoringApproval' => $this->getProctoringApproval(),
            'hubspotDealId' => $this->getHubspotDealId(),
            'validUntil' => $this->formatDateIfGiven($this->getValidUntil()),
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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        if (!in_array($version, CertificationVersion::getAvailableOptions(), true)) {
            throw new \InvalidArgumentException('Invalid certification version');
        }
        $this->version = $version;

        return $this;
    }

    public function getName(): string
    {
        return CertificationType::getName($this->getType());
    }

    public function getUser(): array
    {
        return $this->user;
    }

    public function setUser(array $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getExamLocation(): string
    {
        return $this->examLocation;
    }

    public function setExamLocation(string $examLocation): self
    {
        $this->examLocation = $examLocation;
        return $this;
    }

    public function getExamDate(): ?DateTimeInterface
    {
        return $this->examDate;
    }

    public function setExamDate(?DateTimeInterface $examDate): self
    {
        $this->examDate = $examDate;
        return $this;
    }

    public function getProctoringLink(): ?string
    {
        return $this->proctoringLink;
    }

    public function setProctoringLink(?string $proctoringLink): self
    {
        $this->proctoringLink = $proctoringLink;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getExamUrl(): ?string
    {
        return $this->examUrl;
    }

    public function setExamUrl(?string $examUrl): self
    {
        $this->examUrl = $examUrl;
        return $this;
    }

    public function getExamAccessCode(): ?string
    {
        return $this->examAccessCode;
    }

    public function setExamAccessCode(?string $examAccessCode): self
    {
        $this->examAccessCode = $examAccessCode;
        return $this;
    }

    public function getExamProctoringInstructions(): ?string
    {
        return $this->examProctoringInstructions;
    }

    public function setExamProctoringInstructions(?string $examProctoringInstructions): self
    {
        $this->examProctoringInstructions = $examProctoringInstructions;
        return $this;
    }

    public function getExamStartDate(): ?DateTimeInterface
    {
        return $this->examStartDate;
    }

    public function setExamStartDate(?DateTimeInterface $examStartDate): self
    {
        $this->examStartDate = $examStartDate;
        return $this;
    }

    public function getExamEndDate(): ?DateTimeInterface
    {
        return $this->examEndDate;
    }

    public function setExamEndDate(?DateTimeInterface $examEndDate): self
    {
        $this->examEndDate = $examEndDate;
        return $this;
    }

    public function getExamDuration(): ?int
    {
        return $this->examDuration;
    }

    public function setExamDuration(?int $examDuration): self
    {
        $this->examDuration = $examDuration;
        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): self
    {
        $this->history = $history;
        return $this;
    }

    public function getExamTestResult(): string
    {
        return $this->examTestResult;
    }

    public function setExamTestResult(string $examTestResult): self
    {
        $this->examTestResult = $examTestResult;
        return $this;
    }

    public function getProctoringStatus(): ?string
    {
        return $this->proctoringStatus;
    }

    public function setProctoringStatus(?string $proctoringStatus): self
    {
        $this->proctoringStatus = $proctoringStatus;
        return $this;
    }

    public function getCertificatePrintDate(): ?DateTimeInterface
    {
        return $this->certificatePrintDate;
    }

    public function setCertificatePrintDate(?DateTimeInterface $certificatePrintDate): self
    {
        $this->certificatePrintDate = $certificatePrintDate;
        return $this;
    }

    public function getIncidents(): ?int
    {
        return $this->incidents;
    }

    public function setIncidents(?int $incidents): self
    {
        $this->incidents = $incidents;
        return $this;
    }

    public function getProctoringApproval(): string
    {
        return $this->proctoringApproval;
    }

    public function setProctoringApproval(string $proctoringApproval): self
    {
        $this->proctoringApproval = $proctoringApproval;
        return $this;
    }

    private function formatDateIfGiven(?\DateTimeInterface $dateTime): ?string
    {
        if (!$dateTime instanceof \DateTimeInterface) {
            return null;
        }

        return $dateTime->format(\DateTimeInterface::ATOM);
    }

    public function getHubspotDealId(): ?string
    {
        return $this->hubspotDealId;
    }

    public function setHubspotDealId(?string $hubspotDealId): self
    {
        $this->hubspotDealId = $hubspotDealId;
        return $this;
    }

    public function getValidUntil(): ?DateTimeInterface
    {
        return $this->validUntil;
    }

    public function setValidUntil(?DateTimeInterface $validUntil): self
    {
        $this->validUntil = $validUntil;
        return $this;
    }
}
