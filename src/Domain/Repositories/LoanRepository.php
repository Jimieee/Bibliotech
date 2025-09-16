<?php
namespace App\Domain\Repositories;
use App\Domain\Entities\Loan;
interface LoanRepository {
    /** @return Loan[] */ 
    public function all(): array;
    public function add(Loan $loan): void;
    public function findOpenByBookId(int $bookId): ?Loan;
    public function closeLoan(int $bookId, \DateTimeImmutable $when): void;
}
