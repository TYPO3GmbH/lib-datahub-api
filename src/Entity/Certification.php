<?php declare(strict_types=1);

/*
 * This file is part of the package t3g/datahub-api-library.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace T3G\DatahubApiLibrary\Entity;

use DateTimeInterface;
use JsonSerializable;
use T3G\DatahubApiLibrary\Enum\CertificationAuditType;
use T3G\DatahubApiLibrary\Enum\CertificationProctoringApprovalStatus;
use T3G\DatahubApiLibrary\Enum\CertificationTestResult;
use T3G\DatahubApiLibrary\Enum\CertificationType;
use T3G\DatahubApiLibrary\Enum\CertificationVersion;

class Certification implements JsonSerializable
{
    private string $uuid = '';
    private string $type = '';
    private string $version = '';

    /**
     * @var array<string, mixed>
     */
    private array $user = [];
    private string $auditType = '';
    private string $status = '';
    private string $examLocation = '';
    private ?DateTimeInterface $examDate = null;
    private bool $ndaSigned = false;
    private bool $rulesAccepted = false;
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
    private ?string $appendToHistory = '';
    private ?string $userExamUuid = null;

    /**
     * @var array<string, string|null>
     */
    private array $postFormattedAddress = [];

    public function jsonSerialize()
    {
        return [
            'type' => $this->getType(),
            'version' => $this->getVersion(),
            'auditType' => $this->getAuditType(),
            'examLocation' => $this->getExamLocation(),
            'examDate' => $this->formatDateIfGiven($this->getExamDate()),
            'ndaSigned' => $this->isNdaSigned(),
            'rulesAccepted' => $this->isRulesAccepted(),
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
            'proctoringStatus' => $this->getProctoringStatus(),
            'proctoringApproval' => $this->getProctoringApproval(),
            'hubspotDealId' => $this->getHubspotDealId(),
            'validUntil' => $this->formatDateIfGiven($this->getValidUntil()),
            'postFormattedAddress' => $this->getPostFormattedAddress(),
            'appendToHistory' => $this->getAppendToHistory(),
            'userExamUuid' => $this->getUserExamUuid(),
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

    public function getAuditType(): string
    {
        return $this->auditType;
    }

    public function setAuditType(string $auditType): self
    {
        if (!in_array($auditType, CertificationAuditType::getAvailableOptions(), true)) {
            throw new \InvalidArgumentException('Invalid audit type');
        }
        $this->auditType = $auditType;

        return $this;
    }

    public function getName(): string
    {
        return CertificationType::getName($this->getType());
    }

    /**
     * @return array<string, mixed>
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * @param array<string, mixed> $user
     * @return $this
     */
    public function setUser(array $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * This is a computed value based on different properties.
     *
     * Stages:
     *   * UNKNOWN: early interim state and should never be a real result
     *   * PREPARATION_REQUIRED: the exam needs preparation by the exam taker by signing the NDA, accepting the rules and setting an address
     *   * READY: only ProctorU - all data is set and the exam may be scheduled by the exam taker
     *   * SCHEDULED: if ProctorU, an appointment is made; for on-site exams this is implicitly defined by the exam's event
     *   * WAIT_PROCTOR: only ProctorU - exam is finished and passed, ProctorU either needs to send its results or there are open incidents
     *   * PASSED: the exam is passed; if ProctorU, there are either no incidents or the proctoring has been approved manually
     *   * FAILED: the exam is failed; if ProctorU and the scoring would result in "passed", there are incidents and the proctoring has been declined manually
     *   * IN_PRINT: the print date of the certification is set
     */
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

    public function isNdaSigned(): bool
    {
        return $this->ndaSigned;
    }

    public function setNdaSigned(bool $ndaSigned): self
    {
        $this->ndaSigned = $ndaSigned;

        return $this;
    }

    public function isRulesAccepted(): bool
    {
        return $this->rulesAccepted;
    }

    public function setRulesAccepted(bool $rulesAccepted): self
    {
        $this->rulesAccepted = $rulesAccepted;

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

    public function isSchedulable(): bool
    {
        if (CertificationAuditType::PROCTORU !== $this->getAuditType()) {
            return false;
        }

        return $this->isNdaSigned() && $this->isRulesAccepted() && '' !== $this->getAddress();
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

    /**
     * @return array<string, string|null>
     */
    public function getPostFormattedAddress(): array
    {
        return $this->postFormattedAddress;
    }

    /**
     * @param array<string, string|null> $postFormattedAddress
     * @return $this
     */
    public function setPostFormattedAddress(array $postFormattedAddress): self
    {
        $this->postFormattedAddress = $postFormattedAddress;
        return $this;
    }

    public function getAppendToHistory(): ?string
    {
        return $this->appendToHistory;
    }

    public function setAppendToHistory(?string $appendToHistory): self
    {
        $this->appendToHistory = $appendToHistory;
        return $this;
    }

    public function getUserExamUuid(): ?string
    {
        return $this->userExamUuid;
    }

    public function setUserExamUuid(?string $userExamUuid): self
    {
        $this->userExamUuid = $userExamUuid;
        return $this;
    }
}
