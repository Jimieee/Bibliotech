<?php
namespace App\Infrastructure\Persistence\Session;
use App\Domain\Entities\Loan;
use App\Domain\Repositories\LoanRepository;
use App\Core\SessionStore;

class SessionLoanRepository implements LoanRepository {
    public function __construct(){ SessionStore::start(); }

    public function all(): array {
        $s =& SessionStore::data();
        return array_map(function($r){
            return new Loan((int)$r['bookId'], $r['userName'], new \DateTimeImmutable($r['startAt']), isset($r['endAt']) && $r['endAt'] ? new \DateTimeImmutable($r['endAt']) : null);
        }, $s['loans']);
    }

    public function add(Loan $loan): void {
        $s =& SessionStore::data();
        $s['loans'][] = [
            'bookId'=>$loan->getBookId(),
            'userName'=>$loan->getUserName(),
            'startAt'=>$loan->getStartAt()->format(DATE_ATOM),
            'endAt'=>null
        ];
    }

    public function findOpenByBookId(int $bookId): ?Loan {
        $s =& SessionStore::data();
        foreach ($s['loans'] as $r) {
            if ($r['bookId'] === $bookId && empty($r['endAt'])) {
                return new Loan((int)$r['bookId'], $r['userName'], new \DateTimeImmutable($r['startAt']), null);
            }
        }
        return null;
    }

    public function closeLoan(int $bookId, \DateTimeImmutable $when): void {
        $s =& SessionStore::data();
        foreach ($s['loans'] as &$r) {
            if ($r['bookId'] === $bookId && empty($r['endAt'])) {
                $r['endAt'] = $when->format(DATE_ATOM);
                break;
            }
        }
    }
}
