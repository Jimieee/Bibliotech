<?php
namespace App\Presentation\Controllers;
use App\Application\Services\{LoanService, BookService};

class LoanController {
    public function __construct(private LoanService $svc, private BookService $books) {}

    public function index(): string {
        $loans = $this->svc->all();
        // Enriquecer con título del libro
        $viewLoans = array_map(function($l){
            return [
                'bookId' => $l->getBookId(),
                'userName' => $l->getUserName(),
                'startAt' => $l->getStartAt(),
                'endAt' => $l->getEndAt(),
            ];
        }, $loans);

        // map titles
        foreach ($viewLoans as &$row) {
            $b = $this->books->find($row['bookId']);
            $row['title'] = $b ? $b->getTitle() : '—';
        }

        ob_start(); $data = ['loans'=>$viewLoans]; include __DIR__ . '/../Views/loans.php'; return ob_get_clean();
    }

    public function borrow(): string { $msg = $this->svc->borrow((int)$_POST['bookId'], $_POST['userName']); header('Location: /?flash=' . urlencode($msg)); exit; }
    public function giveBack(): string { $msg = $this->svc->giveBack((int)$_POST['bookId']); header('Location: /?flash=' . urlencode($msg)); exit; }
}
