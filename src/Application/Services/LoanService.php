<?php
namespace App\Application\Services;
use App\Domain\Repositories\{BookRepository,LoanRepository};
use App\Domain\Entities\Loan;

class LoanService {
    public function __construct(private BookRepository $books, private LoanRepository $loans) {}

    public function borrow(int $bookId, string $userName): string {
        $book = $this->books->find($bookId);
        if (!$book) return "Libro no encontrado";
        if (!$book->isAvailable()) return "No disponible";
        $open = $this->loans->findOpenByBookId($bookId);
        if ($open) return "Ya está prestado";
        $this->loans->add(new Loan($bookId, $userName, new \DateTimeImmutable()));
        $book->setAvailable(false); $this->books->update($book);
        return "Préstamo registrado";
    }

    public function giveBack(int $bookId): string {
        $book = $this->books->find($bookId); if (!$book) return "Libro no encontrado";
        $open = $this->loans->findOpenByBookId($bookId); if (!$open) return "No hay préstamo abierto";
        $this->loans->closeLoan($bookId, new \DateTimeImmutable());
        $book->setAvailable(true); $this->books->update($book);
        return "Devuelto";
    }
    /** @return Loan[] */
    public function all(): array { return $this->loans->all(); }
}
