<?php
namespace App\Domain\Entities;
class Loan {
    public function __construct(
        private int $bookId,
        private string $userName,
        private \DateTimeImmutable $startAt,
        private ?\DateTimeImmutable $endAt = null
    ) {}
    
    public function getBookId(): int { return $this->bookId; }
    public function getUserName(): string { return $this->userName; }
    public function getStartAt(): \DateTimeImmutable { return $this->startAt; }
    public function getEndAt(): ?\DateTimeImmutable { return $this->endAt; }
    public function close(\DateTimeImmutable $when): void { $this->endAt = $when; }
}
